<?php

declare(strict_types = 1);

/**
 * Classe représentant un petit bouton dans la navbar en HTML.
 * @type navbar-button
 * @brief Classe représentant un petit bouton dans la navbar en HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
class NavbarButton extends HTMLContent
{

    private string $text;
    private string $url;

    /**
     * Constructeur de la classe NavbarButton.
     * @brief Constructeur de la classe NavbarButton.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->text = "";
        $this->url = "";
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : NavbarButton
    {
        $navbarButton = new NavbarButton();
        $navbarButton->setText($data["text"]);
        $navbarButton->setUrl($data["url"]);
        return $navbarButton;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @brief Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateHtml() : string
    {
        $this->appendHtml("<div class=\"navbar-button\" url=\"".$this->url."\">".$this->text."</div>");
        return $this->html;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @brief Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateAdminHtml() : string
    {
        $this->appendHtml("<div class=\"navbar-button\" url=\"".$this->url."\">".$this->text."</div>");
        return $this->html;
    }

    /**
     * Cette méthode affecte un nouveau texte au bouton.
     * @brief Cette méthode affecte un nouveau texte au bouton.
     * @param string $text Le texte à affecter.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode affecte un url de redirection au bouton.
     * @brief Cette méthode affecte un url de redirection au bouton.
     * @param string $url L'url de redirection à affecter.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * Cette méthode retourne le texte du bouton.
     * @brief Cette méthode retourne le texte du bouton.
     * @return string Le texte du bouton.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * Cette méthode retourne l'url de redirection du bouton.
     * @brief Cette méthode retourne l'url de redirection du bouton.
     * @return string L'url de redirection du bouton.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getUrl() : string
    {
        return $this->url;
    }
    
}