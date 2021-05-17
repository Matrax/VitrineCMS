<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");
require_once("../php/controllers/FrontLogger.php");

if(Admin::isConnected() && isset($_FILES["image"]))
{
    $temp_name = $_FILES["image"]["tmp_name"];
    $name = $_FILES["image"]["name"];
    $result = move_uploaded_file($temp_name, "../content/images/".$name);
    if($result == false) FrontLogger::error("Erreur à l'upload d'une image !");
}