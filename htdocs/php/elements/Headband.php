<?php

declare(strict_types = 1);

/**
 * Classe représentant un bandeau.
 * Le bandeau est cliquable pour aller vers un lien.
 * @type headband
 * @brief Classe représentant un bandeau.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Headband extends HTMLContent
{

    private string $text;
    private string $image;
    private string $url;

    /**
     * Constructeur de la classe Headband.
     * @brief Constructeur de la classe Headband.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->text = "";
        $this->image = "";
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
    public static function loadFromJSON(array $data) : Headband
    {
        $headband = new Headband();
        $headband->setImage($data["image"]);
        $headband->setText($data["text"]);
        $headband->setUrl($data["url"]);
        return $headband;
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
            <div class="headband" url="{$this->url}">
            <img class="headband-image" src="{$this->image}" alt="image" width=100% height=100%>
            <div class="headband-text">{$this->text}</div>
            </div>
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
            <div class="headband" url="{$this->url}">
            <img class="headband-image" src="{$this->image}" alt="image" width=100% height=100%>
            <div class="headband-text">{$this->text}</div>
            </div>
        HTML);
        return $this->html;
    }

    /**
     * Cette méthode affecte l'image du bandeau
     * @param string $image L'image à affecter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * Cette méthode affecte le texte du bandeau
     * @param string $text Le texte à affecter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode affecte l'URL de redirection du bandeau
     * @param string $url L'URL de redirection à affecter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * Cette méthode renvoie l'image du bandeau
     * @return string L'image du bandeau
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getImage() : string
    {
        return $this->image;
    }

    /**
     * Cette méthode renvoie le texte du bandeau
     * @return string Le texte du bandeau
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * Cette méthode renvoie l'URL de redirection du bandeau
     * @return string L'URL de redirection du bandeau.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getUrl() : string
    {
        return $this->url;
    }

}