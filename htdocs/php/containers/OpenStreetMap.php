<?php

declare(strict_types = 1);

/**
 * Classe représentant un panneau openstreetmap.
 * @type openstreet-map
 * @brief Classe représentant un panneau openstreetmap.
 * @author Alexandre Pierret
 * @version 1.0
 */
class OpenStreetMap extends HTMLContent
{

    private int $zoom;
    private float $lat;
    private float $lng;
    private array $locations;

    /**
     * Constructeur de la classe OpenStreetMap.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->zoom = 1;
        $this->lng = 47;
        $this->lat = 3;
        $this->locations = array();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : OpenStreetMap
    {
        $map = new OpenStreetMap();
        $map->setZoom((int) $data["zoom"]);
        $map->setLat((float) $data["lat"]);
        $map->setLng((float) $data["lng"]);
        foreach ($data["elements"] as $key => $value) 
        {
            $map->addLocation($value["lat"], $value["lng"]);
        }
        return $map;
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
        $data["type"] = "openstreet-map";
        $data["zoom"] = "1";
        $data["lat"] = "0";
        $data["lng"] = "0";
        $data["elements"] = array();
        $data["elements"]["0"]["lat"] = "0";
        $data["elements"]["0"]["lng"] = "0";
        $data["elements"]["1"]["lat"] = "1";
        $data["elements"]["1"]["lng"] = "1";
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
        $this->appendHtml("<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css\" type=\"text/css\">");
        $this->appendHtml("<div class=\"openstreet-map\">");
        $this->appendHtml("<div id=\"openstreet-map\" class=\"map-panel\"></div>");
        $this->appendHtml("<div class=\"map-info\" hidden>");
        $this->appendHtml("<div class=\"map-info-zoom\">".$this->zoom."</div>");
        $this->appendHtml("<div class=\"map-info-lat\">".$this->lat."</div>");
        $this->appendHtml("<div class=\"map-info-lng\">".$this->lng."</div>");
        $this->appendHtml("</div>");
        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];
            $this->appendHtml("<div class=\"map-position\" hidden>");
            $this->appendHtml("<div class=\"map-lat\">".$lat."</div>");
            $this->appendHtml("<div class=\"map-lng\">".$lng."</div>");
            $this->appendHtml("</div>");
        }
        $this->appendHtml("</div>");
        $this->appendHtml("<script src=\"https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js\"></script>");
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
        $this->appendHtml("<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.7.1/dist/leaflet.css\" integrity=\"sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==\" crossorigin=\"\"/>");
        $this->appendHtml("<div class=\"element-container\">");
        $this->appendHtml("<div class=\"element\" id=\"".$this->id."\">");
        $this->appendHtml("<div id=\"openstreet-map\" class=\"map-panel\"></div>");
        $this->appendHtml("<div class=\"map-info\" hidden>");
        $this->appendHtml("<div class=\"map-info-zoom\">".$this->zoom."</div>");
        $this->appendHtml("<div class=\"map-info-lat\">".$this->lat."</div>");
        $this->appendHtml("<div class=\"map-info-lng\">".$this->lng."</div>");
        $this->appendHtml("</div>");
        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];
            $this->appendHtml("<div class=\"map-position\" hidden>");
            $this->appendHtml("<div class=\"map-lat\">".$lat."</div>");
            $this->appendHtml("<div class=\"map-lng\">".$lng."</div>");
            $this->appendHtml("</div>");
        }
        $this->appendHtml("</div>");
        $this->appendHtml("<script src=\"https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js\"></script>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Carte</div>");
        $this->appendHtml("<div class=\"element-manager-2\">");
        $this->appendHtml("<input role=\"admin\" target=\"zoom\" id=\"".$this->id."\" value=\"".$this->zoom."\" placeholder=\"Zoom Google Map\">");
        $this->appendHtml("<input role=\"admin\" target=\"lat\" id=\"".$this->id."\" value=\"".$this->lat."\" placeholder=\"Latitude Google Map\">");
        $this->appendHtml("<input role=\"admin\" target=\"lng\" id=\"".$this->id."\" value=\"".$this->lng."\" placeholder=\"Longitude Google Map\">");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">Marqueurs</div>");
        $this->appendHtml("<div class=\"element-manager-3\">");
        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];
            $this->appendHtml("<input role=\"admin\" target=\"lat\" container-id=\"".$this->id."\" id=\"".$key."\" value=\"".$lat."\" placeholder=\"Latitude\">");
            $this->appendHtml("<input role=\"admin\" target=\"lng\" container-id=\"".$this->id."\" id=\"".$key."\" value=\"".$lng."\" placeholder=\"Longitude\">");
            $this->appendHtml("<div class=\"subelement-delete-button\" container-id=\"".$this->id."\" id=\"".$key."\">Supprimer le marqueur</div>");
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
    
    public function setZoom(int $zoom)
    {
        $this->zoom = $zoom;
    }

    public function setLat(float $lat)
    {
        $this->lat = $lat;
    }

    public function setLng(float $lng)
    {
        $this->lng = $lng;
    }

    public function addLocation(string $lat, string $lng)
    {
        array_push($this->locations, $lat.":".$lng);
    }
    
}