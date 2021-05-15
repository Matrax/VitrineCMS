<?php

declare(strict_types = 1);

/**
 * Classe représentant un petit panneau dans la navbar en HTML.
 * @type navbar-item
 * @brief Classe représentant un petit panneau dans la navbar en HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
class NavbarItem extends HTMLContent
{

    private string $text;
    
    /**
     * Constructeur de la classe NavbarItem.
     * @brief Constructeur de la classe NavbarItem.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->text = "";
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : NavbarItem
    {
        $navbarItem = new NavbarItem();
        $navbarItem->setText($data["text"]);
        return $navbarItem;
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
        $this->appendHtml(<<<HTML
            <div class="navbar-item">{$this->text}</div>
        HTML);
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
        $this->appendHtml(<<<HTML
            <div class="navbar-item">{$this->text}</div>
        HTML);
        return $this->html;
    }

    /**
     * Cette méthode affecte un nouveau texte à l'item.
     * @brief Cette méthode affecte un nouveau texte à l'item.
     * @param string $text Le nouveau texte à affecter.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode retourne le texte de l'item
     * @brief Cette méthode retourne le texte de l'item
     * @return string Le texte de l'item.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getText() : string
    {
        return $this->text;
    }

}