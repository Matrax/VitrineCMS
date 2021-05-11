<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected() && isset($_GET["image"]))
{
    unlink("../content/images/".$_GET["image"]);
    header("Location: ".$_SERVER["HTTP_REFERER"]);
}