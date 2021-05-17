<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected())
{
    if(isset($_GET["area"]) && $_GET["area"] != "")
    {
        $area = $_GET["area"];
        $json = <<<JSON
        {
            "0": {
                "type": "head",
                "title": "$area"
            }
        }
        JSON;
        $result = file_put_contents("../webpage/".$_GET["area"].".json", $json);
        if($result == false) FrontLogger::error("Erreur à la sauvegarde du fichier JSON de la page !");
        
        header("Location: ../index.php?area=".$_GET["area"]."&role=admin");
    }
} else {
    header("Location: ../html/connect.html");
}