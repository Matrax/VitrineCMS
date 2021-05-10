<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

function swap(array $array, int $actual, int $other) : array
{
    $temp = $array[$actual];
    $array[$actual] = $array[$other];
    $array[$other] = $temp;
    return $array;
}

if(Admin::isConnected() && isset($_GET["id"]) && isset($_GET["action"]) && isset($_GET["url"]))
{
    $url = "../".$_GET["url"];
    if(file_exists($url))
    {
        $id = (int) $_GET["id"];
        $file = file_get_contents($url);
        $array = array_values(json_decode($file, true));
        switch ($_GET["action"]) {
            case "up":
                if($id > 0) $array = swap($array, $id, $id - 1);
                break;
            case "down":
                if($id < sizeof($array) - 1) $array = swap($array, $id, $id + 1);
                break;
        }
        $json = json_encode($array, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($url, $json);
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
} else {
    header("Location: ../html/connect.html");
}