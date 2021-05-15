<?php

declare(strict_types = 1);

/**
 * Classe représentant un conteneur de bandeau.
 * @type headband-container
 * @name Conteneur de bandeau
 * @brief Classe représentant un conteneur de bandeau.
 * @author Alexandre Pierret
 * @version 1.0
 */
class HeadbandContainer extends HTMLContent
{

    private array $headbands;

    /**
     * Constructeur de la classe HeadbandContainer.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->headbands = array();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : HeadbandContainer
    {
        $headbandContainer = new HeadbandContainer();
        foreach ($data["elements"] as $key => $value) 
        {
            $headband = Headband::loadFromJSON($value);
            $headband->setID((int) $key);
            $headbandContainer->addHeadband($headband);
        }
        return $headbandContainer;
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
        $data["type"] = "headband-container";
        $data["elements"] = array();
        $data["elements"]["0"]["image"] = "content/none.png";
        $data["elements"]["0"]["text"] = "Text";
        $data["elements"]["0"]["url"] = "index";
        $data["elements"]["1"]["image"] = "content/none.png";
        $data["elements"]["1"]["text"] = "Text";
        $data["elements"]["1"]["url"] = "index";
        $data["elements"]["2"]["image"] = "content/none.png";
        $data["elements"]["2"]["text"] = "Text";
        $data["elements"]["2"]["url"] = "index";
        $data["elements"]["3"]["image"] = "content/none.png";
        $data["elements"]["3"]["text"] = "Text";
        $data["elements"]["3"]["url"] = "index";
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
            <div class="headband-container">
        HTML);

        for($i = 0; $i < sizeof($this->headbands); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->headbands[$i]->getHTML()}
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
        HTML);

        return $this->html;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateAdminHtml() : string
    {
        $this->appendHtml(<<<HTML
            <div class="element-container">
            <div class="element" id="{$this->id}">
            <div class="headband-container">
        HTML);

        for($i = 0; $i < sizeof($this->headbands); $i++)
        {
            $this->appendHtml(<<<HTML
                {$this->headbands[$i]->getAdminHtml()}
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            </div>
            <div class="element-title">Contenu des bandeaux</div>
            <div class="element-manager-4">
        HTML);

        foreach ($this->headbands as $key => $value) 
        {
            $this->appendHtml(<<<HTML
                <button role="admin" target="image" container-id="{$this->id}" id="{$value->id}"  value="{$value->getImage()}">{$value->getImage()}</button>
                <button role="admin" target="url" container-id="{$this->id}" id="{$value->id}" value="{$value->getUrl()}">{$value->getUrl()}</button>
                <input role="admin" target="text" container-id="{$this->id}" id="{$value->id}" value="{$value->getText()}">
                <div class="subelement-delete-button" container-id="{$this->id}" id="{$value->id}">Supprimer le bandeau</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <div class="element-title">Options</div>
            <div class="elements-options">
            <div class="subelement-create-button" target="headband" container-id="{$this->id}">Ajouter un bandeau</div>
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
     * Cette méthode ajoute un bandeau au conteneur.
     * @param Headband $headband Le bandeau à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addHeadband(Headband $headband)
    {
        array_push($this->headbands, $headband);
    }

}