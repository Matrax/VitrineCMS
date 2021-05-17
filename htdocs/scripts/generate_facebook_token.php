<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_GET["url"]) && isset($_GET["id"]) && isset($_GET["token"]))
{
    try {
        $url = "../".$_GET["url"];
        $file = file_get_contents($url);
        if($file == false) FrontLogger::error("L'url n'existe pas !");

        $json = json_decode($file, true);
        if($json == false) FrontLogger::error("Erreur au décodage du JSON de la page !");

        $app_id = $json[$_GET["id"]]["app_id"];
        $app_key = $json[$_GET["id"]]["app_key"];
        $token_file = file_get_contents("https://graph.facebook.com/v10.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$app_id."&client_secret=".$app_key."&fb_exchange_token=".$_GET["token"]);
        if($token_file == false) FrontLogger::error("Erreur à l'échange de token facebook (short lived à long lived) !");

        $token_json = json_decode($token_file, true);
        if($token_json == false) FrontLogger::error("Erreur au décodage du token facebook en JSON !");

        $json[$_GET["id"]]["token"] = $token_json["access_token"];
        $result = file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");
        
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    } catch (Throwable $th) {
        echo("Erreur à la génération d'un token facebook.");
    }
} 