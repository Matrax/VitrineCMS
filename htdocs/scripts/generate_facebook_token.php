<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected() && isset($_GET["url"]) && isset($_GET["id"]) && isset($_GET["token"]))
{
    $url = "../".$_GET["url"];
    if(file_exists($url))
    {
        $file = file_get_contents($url);
        $json = json_decode($file, true);
        $id = $_GET["id"];
        $app_id = $json[(string) $id]["app_id"];
        $app_key = $json[(string) $id]["app_key"];
        $token_file = file_get_contents("https://graph.facebook.com/v10.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$app_id."&client_secret=".$app_key."&fb_exchange_token=".$_GET["token"]);
        $token_json = json_decode($token_file, true);
        $token = $token_json["access_token"];
        $json[(string) $id]["token"] = $token;
        file_put_contents($url, json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
} 