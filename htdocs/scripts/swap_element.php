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
    try {
        $url = "../../".$_GET["url"];
        $id = (int) $_GET["id"];

        $file = file_get_contents($url);
        if($file == false) FrontLogger::error("L'url n'existe pas !");

        $json = json_decode($file, true);
        if($json == false) FrontLogger::error("Erreur au décodage du JSON de la page !");
        $array = array_values($json);

        switch ($_GET["action"]) {
            case "up":
                if($id > 0) $array = swap($array, $id, $id - 1);
                break;
            case "down":
                if($id < sizeof($array) - 1) $array = swap($array, $id, $id + 1);
                break;
        }

        $result = file_put_contents($url, json_encode($array, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");
        
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    } catch (Throwable $th) {
        FrontLogger::error("Erreur au swap de deux élements de la page");
    }
} else {
    header("Location: ../html/connect.html");
}