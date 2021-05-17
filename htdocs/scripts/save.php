<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");


if(Admin::isConnected() && isset($_POST) && isset($_POST["url"]) && isset($_POST["json"]))
{
    $url = "../".$_POST["url"];
    
    unlink($url);
    $result = file_put_contents($url, $_POST["json"]);
    if($result == false) FrontLogger::error("Erreur à la sauvegarde de la page !");
}