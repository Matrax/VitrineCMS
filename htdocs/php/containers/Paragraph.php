<?php

declare(strict_types = 1);

/**
 * Classe représentant un paragraphe avec une image en HTML.
 * @type paragraph
 * @brief Classe représentant un paragraphe avec une image en HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Paragraph extends HTMLContent
{

    private string $image;
    private string $title;
    private string $text;

    /**
     * Constructeur de la classe Paragraph.
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
    public static function loadFromJSON(array $data) : Paragraph
    {
        $paragraph = new Paragraph();
        $paragraph->setImage($data["image"]);
        $paragraph->setTitle($data["title"]);
        $paragraph->setText($data["text"]);
        return $paragraph;
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
        $data["type"] = "paragraph";
        $data["title"] = "Title";
        $data["text"] = "Text";
        $data["image"] = "content/none.png";
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
        $this->appendHtml("<div class=\"paragraph\">");
        $this->appendHtml("<img class=\"paragraph-image\" src=\"".$this->image."\" alt=\"image\" width=100% height=100%>");
        $this->appendHtml("<div class=\"paragraph-container\">");
        $this->appendHtml("<div class=\"paragraph-title\">".$this->title."</div>");
        $this->appendHtml("<div class=\"paragraph-text\">".$this->text."</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
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
        $this->appendHtml("<div class=\"paragraph\">");
        $this->appendHtml("<img class=\"paragraph-image\" src=\"".$this->image."\" alt=\"image\" width=100% height=100%>");
        $this->appendHtml("<div class=\"paragraph-container\">");
        $this->appendHtml("<div class=\"paragraph-title\">".$this->title."</div>");
        $this->appendHtml("<div class=\"paragraph-text\">".$this->text."</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Contenu</div>");
        $this->appendHtml("<div class=\"element-manager-2\">");
        $this->appendHtml("<button role=\"admin\" target=\"image\" id=\"".$this->id."\" value=\"".$this->image."\" placeholder=\"URL Image\">".$this->image."</button>");
        $this->appendHtml("<input role=\"admin\" target=\"title\" id=\"".$this->id."\" value=\"".$this->title."\" placeholder=\"Titre\">");
        $this->appendHtml("<textarea role=\"admin\" target=\"text\" id=\"".$this->id."\">".$this->text."</textarea>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Options</div>");
        $this->appendHtml("<div class=\"elements-options\">");
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

    /**
     * Cette méthode affecte une image au paragraphe.
     * @param string $image L'url de l'image à mettre dans le paragraphe
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * Cette méthode affecte un texte au paragraphe.
     * @param string $text Le texte du paragraphe.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode affecte un titre au paragraphe.
     * @param string $title Le titre du paragraphe.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}