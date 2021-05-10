<?php

require_once("php/views/UserView.php");
require_once("php/views/AdminView.php");

/**
 * Classe permettant de générer la vue à l'utilisateur.
 * Le dispatcher peut générer une vue pour l'utilisateur ou l'administrateur.
 * @brief Classe permettant de générer la vue à l'utilisateur.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Dispatcher
{

    /**
     * Constructeur de la classe Dispatcher.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct() {}

    /**
     * Cette méthode permet de diriger l'utilisateur va la vue correspondante
     * et charge tout son contenu.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function dispatch() : View
    {
        $file = $this->readArea();
        $view = $this->generateView();
        $view->loadContents($file);
        return $view;
    }

    /**
     * Cette méthode permet de générer la vue demandée par l'utilisateur ou l'administrateur.
     * Si l'utilisateur n'a pas de role, la vue utilisateur est renvoyé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    private function generateView() : View
    {
        if(FrontController::getInstance()->getRole() == "admin")
        {
            if(Admin::isConnected() == true)
            {
                return new AdminView();
            } else {
                header('Location: scripts/connect.php');
            }
        } else {
            return new UserView();
        }
        return null;
    }

    /**
     * Cette méthode permet de lire le fichier json de la vue demandée avec le paramètre GET area.
     * Si la vue n'existe pas, le fichier index.json est lu à la place.
     * @author Alexandre Pierret
     * @version 1.0
     */
    private function readArea() : string
    {
        if(isset($_GET["area"]) == true) 
        {
            return file_get_contents("webpage/".$_GET["area"].".json");
        } 
        return file_get_contents("webpage/index.json");
    }

}