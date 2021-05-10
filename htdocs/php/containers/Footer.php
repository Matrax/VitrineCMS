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
        $this->appendHtml("<footer class=\"footer\">");
        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml("<img class=\"footer-item\" src=\"".$this->images[$i]."\" alt=\"image\" width=100% height=100%>");
        }
        $this->appendHtml("</footer>");
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
        $this->appendHtml("<div class=\"element-container\">");
        $this->appendHtml("<div class=\"element\" id=\"".$this->id."\">");
        $this->appendHtml("<footer class=\"footer\">");
        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml("<img class=\"footer-item\" container-id=\"".$this->id."\" id=\"".$i."\" src=\"".$this->images[$i]."\" alt=\"image\" width=100% height=100%>");
        }
        $this->appendHtml("</footer>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Images</div>");
        $this->appendHtml("<div class=\"element-manager-2\">");
        for($i = 0; $i < sizeof($this->images); $i++)
        {
            $this->appendHtml("<button role=\"admin\" target=\"image\" container-id=\"".$this->id."\" id=\"".$i."\" value=\"".$this->images[$i]."\" placeholder=\"URL Image\">".$this->images[$i]."</button>");
            $this->appendHtml("<div class=\"subelement-delete-button\" container-id=\"".$this->id."\" id=\"".$i."\">Supprimer l'image</div>");
        }
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Options</div>");
        $this->appendHtml("<div class=\"elements-options\">");
        $this->appendHtml("<div class=\"subelement-create-button\" target=\"footer\" container-id=\"".$this->id."\">Ajouter une image</div>");
        $this->appendHtml("<div class=\"element-delete-button\" id=\"".$this->id."\">Supprimer</div>");
        $this->appendHtml("<svg class=\"element-swap-button\" id=\"".$this->id."\" action=\"up\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\">");
        $this->appendHtml("<path fill-rule=\"evenodd\" d=\"M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z\"/>");
        $this->appendHtml("</svg>");
        $this->appendHtml("<svg class=\"element-swap-button\" id=\"".$this->id."\" action=\"down\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\">");
        $this->appendHtml("<path fill-rule=\"evenodd\" d=\"M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z\"/>");
        $this->appendHtml("</svg>");
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        return $this->html;
    }
    
    public function addImage(string $image)
    {
        array_push($this->images, $image);
    }
    
}