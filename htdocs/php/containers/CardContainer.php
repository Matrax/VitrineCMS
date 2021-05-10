<?php

declare(strict_types = 1);

/**
 * Classe représentant un conteneur de carte en HTML.
 * @type card-container
 * @brief Classe représentant un conteneur de carte en HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
class CardContainer extends HTMLContent
{

    private array $cards;

    /**
     * Constructeur de la classe CardContainer.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->cards = array();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : CardContainer
    {
        $cardContainer = new CardContainer();
        foreach ($data["elements"] as $key => $value) 
        {
            $card = Card::loadFromJSON($value);
            $card->setID((int) $key);
            $cardContainer->addCard($card);
        }
        return $cardContainer;
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
        $data["type"] = "card-container";
        $data["elements"] = array();
        $data["elements"]["0"]["image"] = "content/none.png";
        $data["elements"]["0"]["text"] = "Text";
        $data["elements"]["1"]["image"] = "content/none.png";
        $data["elements"]["1"]["text"] = "Text";
        $data["elements"]["2"]["image"] = "content/none.png";
        $data["elements"]["2"]["text"] = "Text";
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
        $this->appendHtml("<div class=\"card-container\">");
        for($i = 0; $i < sizeof($this->cards); $i++)
        {
            $this->appendHtml($this->cards[$i]->getHTML());
        }
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
        $this->appendHtml("<div class=\"card-container\">");
        for($i = 0; $i < sizeof($this->cards); $i++)
        {
            $this->appendHtml($this->cards[$i]->getAdminHtml());
        }
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Contenu des cartes</div>");
        $this->appendHtml("<div class=\"element-manager-2\">");
        foreach ($this->cards as $key => $value) 
        {
            $this->appendHtml("<button role=\"admin\" target=\"image\" container-id=\"".$this->id."\" id=\"".$value->id."\"  value=\"".$value->getImage()."\" placeholder=\"URL Image\">".$value->getImage()."</button>");
            $this->appendHtml("<input role=\"admin\" target=\"text\" container-id=\"".$this->id."\" id=\"".$value->id."\" value=\"".$value->getText()."\" placeholder=\"Texte\">");
        }
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
     * Cette méthode permet d'ajouter une carte au conteneur de carte.
     * @param Card $card La carte à ajouter.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addCard(Card $card)
    {
        array_push($this->cards, $card);
    }

}