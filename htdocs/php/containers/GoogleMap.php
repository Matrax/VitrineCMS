<?php

declare(strict_types = 1);

/**
 * Classe représentant un panneau google map.
 * @type google-map
 * @name Google Map
 * @brief Classe représentant un panneau google map.
 * @author Alexandre Pierret
 * @version 1.0
 */
class GoogleMap extends HTMLContent
{
    
    private int $zoom;
    private float $lat;
    private float $lng;
    private string $key;
    private array $locations;

    /**
     * Constructeur de la classe GoogleMap.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->key = "";
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
    public static function loadFromJSON(array $data) : GoogleMap
    {
        $map = new GoogleMap();
        $map->setKey($data["key"]);
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
        $data["type"] = "google-map";
        $data["key"] = "";
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
        $this->appendHtml(<<<HTML
            <div class="google-map">
            <div class="map-panel"></div>
            <div class="map-info" hidden>
            <div class="map-info-zoom">{$this->zoom}</div>
            <div class="map-info-lat">{$this->lat}</div>
            <div class="map-info-lng">{$this->lng}</div>
            </div>
        HTML);

        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];

            $this->appendHtml(<<<HTML
                <div class="map-position" hidden>
                <div class="map-lat">{$lat}</div>
                <div class="map-lng">{$lng}</div>
                </div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <script defer src="https://maps.googleapis.com/maps/api/js?key={$this->key}&callback=load&libraries=&v=weekly"></script>
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
            <div class="google-map">
            <div class="map-panel"></div>
            <div class="map-info" hidden>
            <div class="map-info-zoom">{$this->zoom}</div>
            <div class="map-info-lat">{$this->lat}</div>
            <div class="map-info-lng">{$this->lng}</div>
            </div>
        HTML);

        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];

            $this->appendHtml(<<<HTML
                <div class="map-position" hidden>
                <div class="map-lat">{$lat}</div>
                <div class="map-lng">{$lng}</div>
                </div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <script defer src="https://maps.googleapis.com/maps/api/js?key={$this->key}&callback=load&libraries=&v=weekly"></script>
            </div>
            <div class="element-title">Carte</div>
            <div class="element-manager-2">
            <input role="admin" target="key" id="{$this->id}" value="{$this->key}" placeholder="Clé Google Map">
            <input role="admin" target="zoom" id="{$this->id}" value="{$this->zoom}" placeholder="Zoom Google Map">
            <input role="admin" target="lat" id="{$this->id}" value="{$this->lat}" placeholder="Latitude Google Map">
            <input role="admin" target="lng" id="{$this->id}" value="{$this->lng}" placeholder="Longitude Google Map">
            </div>
            <div class="element-title">Marqueurs</div>
            <div class="element-manager-3">
        HTML);

        foreach ($this->locations as $key => $value) 
        {
            $split = explode(":", $value);
            $lat = $split[0];
            $lng = $split[1];

            $this->appendHtml(<<<HTML
                <input role="admin" target="lat" container-id="{$this->id}" id="{$key}" value={$lat} placeholder="Latitude">
                <input role="admin" target="lng" container-id="{$this->id}" id={$key} value={$lng} placeholder="Longitude">
                <div class="subelement-delete-button" container-id="{$this->id}" id="{$key}">Supprimer le marqueur</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
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

    public function setKey(string $key)
    {
        $this->key = $key;
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