<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_GET["id"]) && isset($_GET["url"]))
{
    try {
        $url = "../../".$_GET["url"];
        $file = file_get_contents($url);
        if($file == false) FrontLogger::error("L'url n'existe pas !");

        $json = json_decode($file, true);
        if($json == false) FrontLogger::error("Erreur au décodage du JSON de la page !");

        unset($json[$_GET["id"]]);
        $result = file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");
        
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    } catch (Throwable $th) {
        FrontLogger::error("Cette page n'existe pas, l'élement est donc introuvable !");
    }
} else {
    header("Location: ../html/connect.html");
}