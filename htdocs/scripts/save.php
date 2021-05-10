<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");


if(Admin::isConnected() && isset($_POST) && isset($_POST["url"]) && isset($_POST["json"]))
{
    $url = "../".$_POST["url"];
    if(file_exists($url) == true) unlink($url);
    file_put_contents($url, $_POST["json"]);
}