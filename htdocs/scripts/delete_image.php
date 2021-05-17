<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_GET["image"]))
{
    try {
        unlink("../content/images/".$_GET["image"]);
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    } catch (Throwable $th) {
        FrontLogger::error("Erreur à la suppression de l'image, peut être que l'image n'existe pas.");
    }

}