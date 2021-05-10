<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected() && isset($_GET["url"]) && isset($_GET["container-id"]))
{
    $url = "../".$_GET["url"];
    if(file_exists($url))
    {
        $file = file_get_contents($url);
        $json = json_decode($file, true);
        $id = $_GET["container-id"];
        $lastId = (int) array_key_last($json[(string) $id]["elements"]);
        $elementId = (string) ($lastId + 1);
        $json[(string) $id]["elements"][$elementId]["type"] = "navbar-button";
        $json[(string) $id]["elements"][$elementId]["text"] = "Bouton";
        $json[(string) $id]["elements"][$elementId]["url"] = "index";
        file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
}