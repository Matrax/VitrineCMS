<?php

declare(strict_types = 1);

require_once("php/users/Admin.php");
require_once("php/utils/ClassUtils.php");
require_once("php/utils/Configuration.php");
require_once("php/controllers/Dispatcher.php");

/**
 * Classe permettant de gérer l'affichage des pages web sur le site.
 * Lorsque l'utilisateur souhaite accéder à une certaines partie du site,
 * le front controller va faire en sorte d'afficher la page demander.
 * Cette classe est un Singleton, il est impossible d'avoir plusieurs instances
 * du front controller.
 * Chaque page est d'abord stocké dans un fichier json pour être modifié plus
 * tard plus facilement par le biais de la page administrateur , puis est décodé par
 * le front controller pour l'affiché à l'utilisateur.
 * @brief Classe permettant de gérer l'affichage des pages web sur le site.
 * @author Alexandre Pierret
 * @version 1.0
 */
class FrontController
{

    private static ?FrontController $instance = null;

    private Dispatcher $dispatcher;
    private ?View $view;


    /**
     * Constructeur de la classe FrontController.
     * Cette classe est un singleton, impossible donc de l'instancier plusieurs fois.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        if(FrontController::$instance == null)
        {
            FrontController::$instance = $this;
            $this->dispatcher = new Dispatcher();
            $this->view = null;
        } else {
            echo("Vous ne pouvez pas instancier plusieurs fois un FrontController");
        }
    }

    /**
     * Cette méthode static permet de récuperer l'instance actuel du front controller.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function getInstance() : FrontController
    {
        return FrontController::$instance;
    }

    /**
     * Cette méthode static récupère toutes les pages du site web
     * qui se situent dans le dossier /webpage et les renvoie sous forme de tableau.
     * @return array Toutes les pages du site web sous forme de liste.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getPages()
    {
        $pages = scandir("webpage");
        $list = array();
        for($i = 0; $i < sizeof($pages); $i++)
        {
            if($pages[$i] == "." || $pages[$i] == "..") continue;
            $name = str_replace(".json", "", $pages[$i]);
            array_push($list, $name);
        }
        return $list;
    }
    
    /**
     * Cette méthode permet le rendu de la vue à l'utilisateur.
     * Cette méthode appelle le dispatcher pour choisir la bonne vue
     * puis l'affiche.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function render()
    {
        $this->view = $this->dispatcher->dispatch();
        $this->view->render();
    }

    /**
     * Cette méthode renvoie le role de l'utilisateur.
     * @return string Le role de l'utilisateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getRole() : string
    {
        $role = "user";
        if(isset($_GET["role"]) == true) $role = $_GET["role"];
        return $role;
    }

    /**
     * Cette méthode renvoie le nom de la page actuellement affiché par le front controller.
     * @return string Le nom de la page actuellement affiché par le front controller.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getArea() : string
    {
        $area = "index";
        if(isset($_GET["area"]) == true) $area = $_GET["area"];
        return $area;
    }

}