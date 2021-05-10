<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

Admin::loadSession();
Admin::disconnectSession();

if(Admin::isConnected() == false)
{
    header("Location: ../index.php");
}
