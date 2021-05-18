<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_GET["url"]) && isset($_GET["container-id"]))
{
    try {
        $url = "../../".$_GET["url"];
        $file = file_get_contents($url);
        if($file == false) FrontLogger::error("L'url n'existe pas !");
    
        $json = json_decode($file, true);
        if($json == false) FrontLogger::error("Erreur au décodage du JSON de la page !");

        $lastId = (int) array_key_last($json[$_GET["container-id"]]["elements"]);
        $elementId = (string) ($lastId + 1);
        $json[$_GET["container-id"]]["elements"][$elementId]["image"] = "content/none.png";
        $result = file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");

        header("Location: ".$_SERVER["HTTP_REFERER"]);
    } catch (\Throwable $th) {
        FrontLogger::error("Erreur à la création d'une image dans une gallerie d'image !");
    }
}