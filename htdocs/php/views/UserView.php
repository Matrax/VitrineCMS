<?php

require_once("php/views/View.php");

/**
 * Classe représentant la vue utilisateur.
 * @brief Classe représentant la vue utilisateur.
 * @author Alexandre Pierret
 * @version 1.0
 */
class UserView extends View
{

    /**
     * Classe permettant de créer et manipuler la vue de la page utilisateur.
     * Elle hérite de View qui est la classe mère pour manipuler une page web.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadCssFiles("templates/".$this->getTemplate()."/website");
        $this->loadJsFiles("js/website");
    }

    /**
     * Cette méthode abstraite permet d'afficher la vue à l'utilisateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function render()
    {
        for($i = 0; $i < sizeof($this->getContents()); $i++)
        {
            $this->getBody()->appendHtml($this->getContents()[$i]->getHTML());
        }
        $html = "<!doctype html>";
        $html .= "<html lang=\"fr\">";
        $html .= "<head>";
        $html .= $this->getHead()->getHtml();
        $html .= "</head>";
        $html .= "<body>";
        $html .= $this->getBody()->getHtml();
        if(Configuration::getConfiguration("administration-link") == "yes")
        {
            $html .= "<div class=\"link\">";
            $html .= "<div class=\"go-home\">Accueil</div> | ";
            $html .= "<div class=\"go-admin\">Administration</div>";
            $html .= "</div>";
        }
        $html .= "</body>";
        $html .= "</html>";
        echo($html);
    }
}