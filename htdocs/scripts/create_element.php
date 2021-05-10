<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/utils/ClassUtils.php");
require_once("../php/utils/HTMLContent.php");
ClassUtils::includeAllContainerClasses("../php");

function insert(array $source) : array
{
    $destination = array();
    $class = new ReflectionClass($_GET["type"]);
    $index = 0;
    $dest = 0;
    if((int) $_GET["id"] >= sizeof($source))
    {
        $destination = $source;
        $destination[$_GET["id"]] = array();
        $destination[$_GET["id"]] = ClassUtils::invokeStaticMethod($class, "createJson", $destination[$_GET["id"]]);
    } else {
        while($index < sizeof($source))
        {
            $key = strval($dest);
            $next = strval($dest + 1);
    
            if($key == $_GET["id"])
            {
                $destination[$key] = array();
                $destination[$key] = ClassUtils::invokeStaticMethod($class, "createJson", $destination[$key]);
                $destination[$next] = $source[$index];
                $dest++;
            } else {
                $destination[$key] = $source[$index];
            }
            
            $index++;
            $dest++;
        }
    }
    return $destination;
}

if(Admin::isConnected())
{
    if(isset($_GET["url"]) && isset($_GET["type"]) && isset($_GET["id"]))
    {
        $url = "../".$_GET["url"];
        $file = file_get_contents($url);
        $json = array_values(json_decode($file, true));
        $newJson = insert($json);
        file_put_contents($url, json_encode($newJson, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        var_dump($_SERVER);
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
} else {
    header("Location: ../html/connect.html");
}