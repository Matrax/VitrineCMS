<?php

declare(strict_types = 1);

/**
 * Classe représentant un bas de page.
 * @type footer
 * @name Bas de page
 * @brief Classe représentant un bas de page.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Footer extends HTMLContent
{
    
    private array $images;

    /**
     * Constructeur de la classe Footer.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->images = array();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : Footer
    {
        $footer = new Footer();
        foreach ($data["elements"] as $key => $value) 
        {
            $footer->addImage($value["image"]);
        }
        return $footer;
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
        $data["type"] = "footer";
        $data["elements"] = array();
        $data["elements"]["0"]["image"] = "content/none.png";
        $data["elements"]["1"]["image"] = "content/none.png";
        $data["elements"]["2"]["image"] = "content/none.png";
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
            <footer class="footer">
        HTML);
        
        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml(<<<HTML
                <img class="footer-item" src="{$this->images[$i]}" alt="image" width=100% height=100%>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </footer>
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
            <footer class="footer">
        HTML);

        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml(<<<HTML
                <img class="footer-item" container-id="{$this->id}" id="{$i}" src="{$this->images[$i]}" alt="image" width=100% height=100%>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </footer>
            </div>
            <div class="element-title">Images</div>
            <div class="element-manager-2">
        HTML);

        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml(<<<HTML
                <button role="admin" target="image" container-id="{$this->id}" id="{$i}" value="{$this->images[$i]}" placeholder="URL Image">{$this->images[$i]}</button>
                <div class="subelement-delete-button" container-id="{$this->id}" id={$i}>Supprimer l'image</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <div class="element-title">Options</div>
            <div class="elements-options">
            <div class="subelement-create-button" target="footer" container-id="{$this->id}">Ajouter une image</div>
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
     * Cette méthode permet d'ajouter une image
     * @param string $image L'url de l'image à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addImage(string $image)
    {
        array_push($this->images, $image);
    }
    
}