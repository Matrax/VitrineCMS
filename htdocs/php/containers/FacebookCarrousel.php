<?php

declare(strict_types = 1);

/**
 * Classe représentant un carrousel relié à facebook.
 * @type facebook-carrousel
 * @brief Classe représentant un carrousel relié à facebook.
 * @author Alexandre Pierret
 * @version 1.0
 */
class FacebookCarrousel extends HTMLContent
{

    private string $page_id;
    private string $token;

    /**
     * Constructeur de la classe FacebookCarrousel.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : FacebookCarrousel
    {
        $carrousel = new FacebookCarrousel();
        $carrousel->setToken($data["token"]);
        $carrousel->setPageID($data["page_id"]);
        return $carrousel;
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
        $data["type"] = "facebook-carrousel";
        $data["token"] = "";
        $data["page_id"] = "";
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
        $count = 0;
        $this->appendHtml("<div class=\"facebook-carrousel\">");
        $url = file_get_contents("https://graph.facebook.com/v10.0/".$this->page_id."/feed?fields=message,created_time,full_picture&access_token=".$this->token."&limit=7");
        if($url != false) $feed = json_decode($url, true);
        $this->appendHtml("<div class=\"facebook-carrousel-panel\">");
        $this->appendHtml("<img class=\"facebook-carrousel-logo\" src=\"content/facebook.png\" width=100% height=100%>");
        $this->appendHtml("<div class=\"facebook-carrousel-container\">");
        if(isset($feed))
        {
            $data = array_values($feed["data"]);
            for($i = 0; $i < sizeof($data); $i++)
            {
                if(isset($data[$i]["message"])) 
                {
                    $message = $data[$i]["message"];
                    $time = substr($data[$i]["created_time"], 0, 10);
                    $this->appendHtml("<div class=\"facebook-carrousel-content\" page=\"".$count."\">".$message." | ".$time);
                    if(isset($data[$i]["full_picture"])) 
                    {
                        $full_picture = $data[$i]["full_picture"];
                        $this->appendHtml("<img class=\"facebook-carrousel-image\" src=\"".$full_picture."\" width=100% height=100%>");
                    }
                    $this->appendHtml("</div>");
                    $count++;
                }
            }
        }
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"facebook-carrousel-pagination\">");
        for($i = 0; $i < $count; $i++)
        {
            $this->appendHtml("<div class=\"facebook-carrousel-page\" page=\"".$i."\">O</div>");
        }
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
        $count = 0;
        $this->appendHtml("<div class=\"facebook-carrousel\">");
        $url = file_get_contents("https://graph.facebook.com/v10.0/".$this->page_id."/feed?access_token=".$this->token."&limit=5");
        if($url != false) $feed = json_decode($url, true);
        $this->appendHtml("<div class=\"facebook-carrousel-panel\">");
        $this->appendHtml("<img class=\"facebook-carrousel-image\" src=\"content/facebook.png\" width=100% height=100%>");
        $this->appendHtml("<div class=\"facebook-carrousel-container\">");
        if(isset($feed))
        {
            $data = array_values($feed["data"]);
            for($i = 0; $i < sizeof($data); $i++)
            {
                if(isset($data[$i]["message"]) == false) continue;
                $time = substr($data[$i]["created_time"], 0, 10);
                $this->appendHtml("<div class=\"facebook-carrousel-content\" page=\"".$i."\">".$data[$i]["message"]." | ".$time."</div>");
                $count++;
            }
        }
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"facebook-carrousel-pagination\">");
        for($i = 0; $i < $count; $i++)
        {
            $this->appendHtml("<div class=\"facebook-carrousel-page\" page=\"".$i."\">O</div>");
        }
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("</div>");
        $this->appendHtml("<div class=\"element-title\">ID et token</div>");
        $this->appendHtml("<div class=\"element-manager-2\">");
        $this->appendHtml("<input role=\"admin\" target=\"page_id\" id=\"".$this->id."\" value=\"".$this->page_id."\" placeholder=\"ID de la page\">");
        $this->appendHtml("<input role=\"admin\" target=\"token\" id=\"".$this->id."\" value=\"".$this->token."\" placeholder=\"Token page\">");
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

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function setPageID(string $page_id)
    {
        $this->page_id = $page_id;
    }

}