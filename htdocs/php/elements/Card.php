<?php

declare(strict_types = 1);

/**
 * Classe représentant une carte.
 * @type card
 * @brief Classe représentant une carte.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Card extends HTMLContent
{

    private string $text;
    private string $image;

    /**
     * Constructeur de la classe Card.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->text = "";
        $this->image = "";
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : Card
    {
        $card = new Card();
        $card->setImage($data["image"]);
        $card->setText($data["text"]);
        return $card;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateHtml() : string
    {
        $this->appendHtml("<div class=\"card\">");
        $this->appendHtml("<img class=\"card-image\" src=\"".$this->image."\" alt=\"image\">");
        $this->appendHtml("<div class=\"card-text\">".$this->text."</div>");
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
        $this->appendHtml("<div class=\"card\">");
        $this->appendHtml("<img class=\"card-image\" src=\"".$this->image."\" alt=\"image\" width=100% height=100%>");
        $this->appendHtml("<div class=\"card-text\">".$this->text."</div>");
        $this->appendHtml("</div>");
        return $this->html;
    }

    /**
     * Cette méthode affecte l'image de la carte.
     * @param string $image L'image à affecter.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * Cette méthode affecte le texte en dessous de la carte.
     * @param string $image Le texte à mettre.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Cette méthode renvoie l'image de la carte.
     * @return string L'image de la carte
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getImage() : string
    {
        return $this->image;
    }

    /**
     * Cette méthode renvoie le texte de la carte.
     * @return string Le texte de la carte
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getText() : string
    {
        return $this->text;
    }

}