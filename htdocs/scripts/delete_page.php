<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_GET["url"]))
{
    try {
        if($_GET["url"] != "index" && $_GET["url"] != "mentions")
        {
            $url = "../../".$_GET["url"];
            unlink($url);
            header("Location: ../index.php?role=admin");
        } else {
            FrontLogger::error("Impossible de supprimer la page d'accueil ou la page mentions légales.");
        }
    } catch (Throwable $th) {
        FrontLogger::error("Erreur à la suppression de la page.");
    }
} else {
    header("Location: ../html/connect.html");
}