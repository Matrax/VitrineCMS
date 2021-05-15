<?php

declare(strict_types = 1);

/**
 * Classe représentant un panel en HTML.
 * @type panel
 * @name Panneau de texte
 * @brief Classe représentant un panel en HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Panel extends HTMLContent
{

    private string $title;
    private string $text;

    /**
     * Constructeur de la classe Panel.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->image = "";
        $this->title = "";
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
    public static function loadFromJSON(array $data) : Panel
    {
        $panel = new Panel();
        $panel->setTitle($data["title"]);
        $panel->setText($data["text"]);
        return $panel;
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
        $data["type"] = "panel";
        $data["title"] = "Title";
        $data["text"] = "Text";
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
            <div class="panel">
            <div class="panel-title">{$this->title}</div>
            <div class="panel-text">{$this->text}</div>
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
            <div class="element\" id="{$this->id}">
            <div class="panel">
            <div class="panel-title">{$this->title}</div>
            <div class="panel-text">{$this->text}</div>
            </div>
            </div>
            <div class="element-title">Contenu</div>
            <div class="element-manager-2">
            <input role="admin" target="title" id="{$this->id}" value="{$this->title}" placeholder="Titre">
            <textarea role="admin" target="text" id="{$this->id}">{$this->text}</textarea>
            </div>
            <div class="element-title">Options</div>
            <div class="elements-options">
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
     * Cette méthode affecte le texte du panel.
     * @param string $text Le nouveau texte du panel.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode affecte le titre du panel.
     * @param string $text Le nouveau titre du panel.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}