<?php

declare(strict_types = 1);

require_once("php/utils/Configuration.php");
Configuration::loadConfiguration("../configuration.json");
require_once("php/controllers/Dispatcher.php");
require_once("php/controllers/FrontController.php");
require_once("php/users/Admin.php");
require_once("php/utils/ClassUtils.php");
require_once("php/utils/HTMLContent.php");
require_once("php/elements/NavbarButton.php");
require_once("php/elements/NavbarItem.php");
require_once("php/elements/Body.php");
require_once("php/elements/Head.php");
require_once("php/elements/Headband.php");
require_once("php/elements/Card.php");
require_once("php/containers/Footer.php");
require_once("php/containers/Navbar.php");
require_once("php/containers/Banner.php");
require_once("php/containers/Panel.php");
require_once("php/containers/Paragraph.php");
require_once("php/containers/OpenStreetMap.php");
require_once("php/containers/GoogleMap.php");
require_once("php/containers/FacebookCarrousel.php");
require_once("php/containers/Gallery.php");
require_once("php/containers/MailSender.php");
require_once("php/containers/HeadbandContainer.php");
require_once("php/containers/CardContainer.php");

//Controlleur de la vue
$controller = new FrontController();
$controller->render();