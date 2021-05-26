<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/controllers/FrontLogger.php");

try {
    $file = file_get_contents("../../configuration.json");
    if($file == false) FrontLogger::error("L'url n'existe pas !");

    $json = json_decode($file, true);
    if($json == false) FrontLogger::error("Erreur au décodage du JSON de la page !");

    if(isset($_POST) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["new_password"]))
    {
        $goodLogin = $json["login"];
        $goodPassword = $json["password"];
        $crypted = hash("sha512", $_POST["password"]);

        if(htmlentities($goodLogin) == htmlentities($_POST["login"]) && htmlentities($goodPassword) == htmlentities($crypted))
        {
            $json["password"] = hash("sha512", htmlentities($_POST["new_password"]));
            $result = file_put_contents("../../configuration.json", json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");
        }
    }

    header("Location: ../index.php?role=admin");
} catch (Throwable $th) {
    FrontLogger::error("Erreur à la création d'un nouveau mot de passe !");
}