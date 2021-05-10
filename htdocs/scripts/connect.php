<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(isset($_POST) && isset($_POST["login"]) && isset($_POST["password"]))
{
    Admin::connectSession(htmlentities($_POST["login"]), hash("sha512", htmlentities( $_POST["password"])));
}

if(Admin::isConnected() == true)
{
    header("Location: ../index.php?role=admin");
} else {
    header("Location: ../html/connect.html");
}