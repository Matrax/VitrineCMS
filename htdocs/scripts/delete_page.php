<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected() && isset($_GET["url"]))
{
    if($_GET["url"] != "index")
    {
        $url = "../".$_GET["url"];
        if(file_exists($url) == true) unlink($url);
        header("Location: ../index.php?role=admin");
    } else {
        header("Location: ../html/delete_page_error.html");
    }
} else {
    header("Location: ../html/connect.html");
}