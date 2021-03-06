<?php

declare(strict_types = 1);

/**
 * Classe représentant une barre de navigation.
 * @type navbar
 * @name Barre de navigation
 * @brief Classe représentant une barre de navigation.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Navbar extends HTMLContent
{

    private array $navbarButtons;
    private array $navbarItems;

    /**
     * Constructeur de la classe Navbar.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->navbarButtons = array();
        $this->navbarItems = array();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : Navbar
    {
        $navbar = new Navbar();
        foreach ($data["elements"] as $key => $value) 
        {
            if($value["type"] == "navbar-button")
            {
                $navbarButton = NavbarButton::loadFromJSON($value);
                $navbarButton->setID((int) $key);
                $navbar->addNavbarButton($navbarButton);
            } else {
                $navbarItem = NavbarItem::loadFromJSON($value);
                $navbarItem->setID((int) $key);
                $navbar->addNavbarItem($navbarItem);
            }
        }
        return $navbar;
    }

    /**
     * Cette fonction permet de sauvegarder dans le fichier json d'une page
     * les informations correspondante au conteneur de la classe.
     * @param array $data Les données de l'objet
     * @return array les données de l'objet sauvegardé
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function createJson(array $data) : array
    {
        $data["type"] = "navbar";
        $data["elements"] = array();
        $data["elements"]["0"]["type"] = "navbar-button";
        $data["elements"]["0"]["text"] = "Bouton";
        $data["elements"]["0"]["url"] = "index";
        $data["elements"]["1"]["type"] = "navbar-item";
        $data["elements"]["1"]["text"] = "Test";
        return $data;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateHtml() : string
    {
        $this->appendHtml(<<<HTML
            <nav class="navbar">
        HTML);

        for($i = 0; $i < sizeof($this->navbarButtons); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->navbarButtons[$i]->getHtml()}
            HTML);
        }

        for($i = 0; $i < sizeof($this->navbarItems); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->navbarItems[$i]->getHtml()}
            HTML);
        }

        $this->appendHtml(<<<HTML
            </nav>
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
            <div class="element-container">
            <div class="element" id="{$this->id}">
            <nav class="navbar">
        HTML);

        for($i = 0; $i < sizeof($this->navbarButtons); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->navbarButtons[$i]->getAdminHtml()}
            HTML);
        }

        for($i = 0; $i < sizeof($this->navbarItems); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->navbarItems[$i]->getAdminHtml()}
            HTML);
        }

        $this->appendHtml(<<<HTML
            </nav>
            </div>
            <div class="element-title">Boutons</div>
            <div class="element-manager-3">
        HTML);

        foreach ($this->navbarButtons as $key => $value) 
        {
            $this->appendHtml(<<<HTML
                <input role="admin" target="text" container-id="{$this->id}" id="{$value->id}" value="{$value->getText()}">
                <button role="admin" target="url" container-id="{$this->id}" id="{$value->id}" value="{$value->getUrl()}">{$value->getUrl()}</button>
                <div class="subelement-delete-button" container-id="{$this->id}" id="{$value->id}">Supprimer le bouton</div>
                </div>
                <div class="element-title">Items</div>
                <div class="element-manager-3">
            HTML);
        }

        foreach ($this->navbarItems as $key => $value) 
        {
            $this->appendHtml(<<<HTML
                <input role="admin" target="text" container-id="{$this->id}" id="{$value->id}" value="{$value->getText()}">
                <div class="subelement-delete-button" container-id="{$this->id}" id="{$value->id}">Supprimer l'item</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <div class="element-title">Options</div>
            <div class="elements-options">
            <div class="subelement-create-button" target="navbar-item" container-id="{$this->id}">Ajouter un item</div>
            <div class="subelement-create-button" target="navbar-button" container-id="{$this->id}">Ajouter un bouton</div>
            <div class="element-delete-button" id="{$this->id}">Supprimer</div>
            <svg class="element-swap-button" id="{$this->id}" action="up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <svg class="element-swap-button" id="{$this->id}" action="down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
            </svg>
            </div>
            </div>
        HTML);

        return $this->html;
    }

    /**
     * Cette méthode ajoute un bouton à la barre de navigation.
     * @param NavbarButton $navbarButton Le bouton à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addNavbarButton(NavbarButton $navbarButton)
    {
        array_push($this->navbarButtons, $navbarButton);
    }

    /**
     * Cette méthode ajoute un item à la barre de navigation.
     * @param NavbarItem $navbarItem L'item à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addNavbarItem(NavbarItem $navbarItem)
    {
        array_push($this->navbarItems, $navbarItem);
    }

}