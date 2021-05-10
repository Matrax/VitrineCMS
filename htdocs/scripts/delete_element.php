<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected() && isset($_GET["id"]) && isset($_GET["url"]))
{
    $url = "../".$_GET["url"];
    if(file_exists($url))
    {
        $file = file_get_contents($url);
        $json = json_decode($file, true);
        unset($json[$_GET["id"]]);
        file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
} else {
    header("Location: ../html/connect.html");
}