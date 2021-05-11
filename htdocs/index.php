<?php

declare(strict_types = 1);

require_once("php/utils/Configuration.php");
Configuration::loadConfiguration("../configuration.json");
require_once("php/controllers/Dispatcher.php");
require_once("php/controllers/FrontController.php");
require_once("php/utils/ClassUtils.php");
require_once("php/utils/HTMLContent.php");
require_once("php/users/Admin.php");
ClassUtils::includeAllContainerClasses("php");

//Controlleur de la vue
$controller = new FrontController();
$controller->render();