<?php

require_once("php/views/View.php");

/**
 * Classe représentant la vue administrateur.
 * @type navbar
 * @brief Classe représentant la vue administrateur.
 * @author Alexandre Pierret
 * @version 1.0
 */
class AdminView extends View
{

    /**
     * Classe permettant de créer et manipuler la vue de la page administrateur.
     * Elle hérite de View qui est la classe mère pour manipuler une page web.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadCssFiles("templates/".$this->getTemplate()."/website");
        $this->loadCssFiles("templates/".$this->getTemplate()."/administration");
        $this->loadJsFiles("js/administration");
    }

    /**
     * Cette méthode abstraite permet d'afficher la vue à l'utilisateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function render()
    {
        $this->getBody()->appendHtml("<button role=\"admin\" class=\"add-button\" target=\"container\" target-id=\"1\">Ajouter un élement</button>");
        for($i = 0; $i < sizeof($this->getContents()); $i++)
        {
            $this->getBody()->appendHtml($this->getContents()[$i]->getAdminHtml());
            $this->getBody()->appendHtml("<button role=\"admin\" class=\"add-button\" target=\"container\" target-id=\"".($i + 2)."\">Ajouter un élement</button>");
        }
        $html = "<!doctype html>";
        $html .= "<html lang=\"fr\">";
        $html .= "<head>";
        $html .= $this->getHead()->getAdminHtml();
        $html .= "</head>";
        $html .= "<body>";
        $html .= $this->getNavbar();
        $html .= "<div class=\"element-container\">";
        $html .= "<div class=\"element-title\">Titre de la page</div>";
        $html .= "<div class=\"element-manager-2\">";
        $html .= "<input role=\"admin\" type=\"head\" id=\"0\" target=\"title\" value=\"".$this->getHead()->getTitle()."\">";
        $html .= "</div>";
        $html .= "</div>";
        $html .= $this->getBody()->getAdminHtml();
        $html .= $this->getImageModal();
        $html .= $this->getUrlModal();
        $html .= $this->getContainerModal();
        $html .= "<div id=\"json\" url=\"webpage/".FrontController::getInstance()->getArea().".json\" hidden>";
        $html .= $this->getFile();
        $html .= "</div>";
        $html .= "</body></html>";
        echo($html);
    }

    private function getNavbar() : string
    {
        $pages = FrontController::getInstance()->getPages();
        $html = "<div class=\"navbar-administration\">";
        $html .= "<div class=\"navbar-line\">";
        for($i = 0; $i < sizeof($pages); $i++)
        {
            $html .= "<div class=\"navbar-button-administration bg-white\">".$pages[$i]."</div>";
        }
        $html .= "</div>";
        $html .= "<div class=\"navbar-line\">";
        $html .= "<div class=\"navbar-button-save-administration\" id=\"button-save\">Sauvegarder la page</div>";
        if(isset($_GET["area"]) && $_GET["area"] != "index")
        {
            $html .= "<div class=\"navbar-button-delete-administration\" id=\"button-delete\">Supprimer cette page</div>";
        }
        $html .= "<div class=\"navbar-button-quit-administration\" id=\"button-home\">Retour au site</div>";
        $html .= "<div class=\"navbar-button-disconnect-administration\" id=\"button-disconnect\">Déconnexion</div>";
        $html .= "<div class=\"navbar-button-create-administration\" id=\"button-create\">Créer une page</div>";
        $html .= "<input class=\"navbar-create-input\" type=\"text\" placeholder=\"Nom de la nouvelle page\">";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    private function getImageModal() : string
    {
        $html = "<div class=\"modal-admin\" id=\"modal-image-admin\">";
        $html .= "<div class=\"modal-content\">";
        $html .= "<div class=\"modal-image-content\">";
        foreach (array_diff(scandir("content/images"), [".", ".."]) as $key => $value) 
        {
            $html .= "<img class=\"modal-image\" src=\"content/images/".$value."\" width=100px height=100px>";
        }
        $html .= "</div>";
        $html .= "<div class=\"modal-button-content\">";
        $html .= "<input class=\"modal-add-button\" type=\"file\">";
        $html .= "<div class=\"modal-close-button\">Retour</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    private function getUrlModal() : string
    {
        $pages = FrontController::getInstance()->getPages();
        $html = "<div class=\"modal-admin\" id=\"modal-url-admin\">";
        $html .= "<div class=\"modal-content\">";
        $html .= "<div class=\"modal-url-content\">";
        for($i = 0; $i < sizeof($pages); $i++)
        {
            $html .= "<div class=\"modal-url\" value=\"".$pages[$i]."\">".$pages[$i]."</div>";
        }
        $html .= "</div>";
        $html .= "<div class=\"modal-button-content\">";
        $html .= "<div class=\"modal-close-button\">Retour</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    private function getContainerModal() : string
    {
        $containers = ClassUtils::getAllContainerClasses();
        $html = "<div class=\"modal-admin\" id=\"modal-container-admin\">";
        $html .= "<div class=\"modal-content\">";
        $html .= "<div class=\"modal-container-content\">";
        foreach ($containers as $key => $value) 
        {
            switch($value)
            {
                case "Banner":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Bannière</div>";
                    break;
                case "CardContainer":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Conteneur de carte</div>";
                    break;
                case "Footer":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Bas de page</div>";
                    break;
                case "Navbar":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Barre de navigation</div>";
                    break;
                case "GoogleMap":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Map GoogleMap</div>";
                    break;
                case "OpenStreetMap":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Map OpenStreetMap</div>";
                    break;
                case "HeadbandContainer":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Conteneur de bandeau</div>";
                    break;
                case "MailSender":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Formulaire de contact</div>";
                    break;
                case "Paragraph":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Paragraphe avec image</div>";
                    break;
                case "Panel":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Panneau de texte</div>";
                    break;
                case "FacebookCarrousel":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Carrousel Facebook</div>";
                    break;
                case "Gallery":
                    $html .= "<div class=\"modal-container\" value=\"".$value."\">Gallerie d'image</div>";
                    break;
            }
        }
        $html .= "</div>";
        $html .= "<div class=\"modal-button-content\">";
        $html .= "<div class=\"modal-close-button\">Retour</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

}