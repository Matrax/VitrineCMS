<?php

declare(strict_types = 1);

/**
 * Classe représentant un carrousel relié à facebook.
 * @type facebook-carrousel
 * @name Carrousel Facebook
 * @brief Classe représentant un carrousel relié à facebook.
 * @author Alexandre Pierret
 * @version 1.0
 */
class FacebookCarrousel extends HTMLContent
{

    private string $app_id;
    private string $app_key;
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
        $carrousel->setAppID($data["app_id"]);
        $carrousel->setAppKey($data["app_key"]);
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
        $data["app_id"] = "";
        $data["app_key"] = "";
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

        $this->appendHtml(<<<HTML
            <div class="facebook-carrousel">
            <div class="facebook-carrousel-panel">
            <img class="facebook-carrousel-logo" src="content/facebook.png" width=100% height=100%>
            <div class="facebook-carrousel-container">
        HTML);
        
        try {
            $data = $this->getDataFromFB();
            for($i = 0; $i < sizeof($data); $i++)
            {
                if(isset($data[$i]["message"]) == true
                && isset($data[$i]["created_time"]) == true) 
                {
                    $message = $data[$i]["message"];
                    $time = substr($data[$i]["created_time"], 0, 10);
                    $this->appendHtml(<<<HTML
                        <div class="facebook-carrousel-content" page="{$count}">"$message" | $time
                    HTML);
    
                    if(isset($data[$i]["full_picture"])) 
                    {
                        $full_picture = $data[$i]["full_picture"];
                        $this->appendHtml(<<<HTML
                            <img class="facebook-carrousel-image" src="{$full_picture}" width=100% height=100%>
                        HTML);
                    }
    
                    $this->appendHtml(<<<HTML
                        </div>
                    HTML);
    
                    $count++;
                }
            }
        } catch (Throwable $th) {
            $this->appendHtml("Aucun méssage Facebook");
        }

        $this->appendHtml(<<<HTML
            </div>
            </div>
            <div class="facebook-carrousel-pagination">
        HTML);

        for($i = 0; $i < $count; $i++)
        {
            $this->appendHtml(<<<HTML
                <div class="facebook-carrousel-page" page="$i">O</div>
            HTML);
        }
        $this->appendHtml(<<<HTML
            </div>
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
        $count = 0;

        $this->appendHtml(<<<HTML
            <div class="element-container">
            <div class="element" id="{$this->id}">
            <div class="facebook-carrousel">
            <div class="facebook-carrousel-panel">
            <img class="facebook-carrousel-logo" src="content/facebook.png" width=100% height=100%>
            <div class="facebook-carrousel-container">
        HTML);
        
        try {
            $data = $this->getDataFromFB();
            for($i = 0; $i < sizeof($data); $i++)
            {
                if(isset($data[$i]["message"]) == true
                && isset($data[$i]["created_time"]) == true) 
                {
                    $message = $data[$i]["message"];
                    $time = substr($data[$i]["created_time"], 0, 10);
                    $this->appendHtml(<<<HTML
                        <div class="facebook-carrousel-content" page="{$count}">"$message" | $time
                    HTML);
    
                    if(isset($data[$i]["full_picture"])) 
                    {
                        $full_picture = $data[$i]["full_picture"];
                        $this->appendHtml(<<<HTML
                            <img class="facebook-carrousel-image" src="{$full_picture}" width=100% height=100%>
                        HTML);
                    }
    
                    $this->appendHtml(<<<HTML
                        </div>
                    HTML);
    
                    $count++;
                }
            }
        } catch (Throwable $th) {
            $this->appendHtml("Impossible de récupérer les données de l'API Facebook, peut être que le token est invalide.");
        }

        $this->appendHtml(<<<HTML
            </div>
            </div>
            <div class="facebook-carrousel-pagination">
        HTML);

        for($i = 0; $i < $count; $i++)
        {
            $this->appendHtml(<<<HTML
                <div class="facebook-carrousel-page" page={$i}>O</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            </div>
            </div>
            <div class="element-title">ID et token</div>
            <div class="element-manager-2">
            <input role="admin" target="page_id" id="{$this->id}" value="{$this->page_id}" placeholder="ID de la page">
            <input role="admin" target="app_id" id="{$this->id}" value="{$this->app_id}" placeholder="ID Application">
            <input role="admin" target="app_key" id="{$this->id}" value="{$this->app_key}" placeholder="Clé Application">
            <input role="admin" target="token" id="{$this->id}" value="{$this->token}" placeholder="Token d'accés" disabled>
            <button class="element-facebook-token" role="admin" target="token" id="{$this->id}" value="{$this->token}">Regénérer le token</button>
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
            <script src="js/administration/facebook-token.js"></script>
            {$this->generateScript()}
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js"></script>
        HTML);
        
        return $this->html; 
    }

    /**
     * Cette méthode génère le script d'initialisation de l'api Facebook
     * @return string Le script d'initialisation de l'api Facebook
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function generateScript() : string
    {
        return <<<HTML
        <script>
            window.fbAsyncInit = function() 
            {
                FB.init({
                    appId            : {$this->id},
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v10.0'
                });
            }
            generateTokenButtonEvent();
        </script>
        HTML;
    }

    /**
     * Cette méthode récupère à l'aide de l'identifiant de la page
     * et le token, les données des méssages associé à la page facebook.
     * @return array Les données de la page facebook
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getDataFromFB() : array
    {
        $path = "https://graph.facebook.com/v10.0/".$this->page_id."/feed?fields=message,created_time,full_picture&access_token=".$this->token."&limit=7";
        $file = file_get_contents($path);
        $feed = json_decode($file, true);
        $data = array_values($feed["data"]);
        return $data;
    }

    /**
     * Cette méthode affecte le token d'accés page.
     * @param string $token Le nouveau token d'accés page.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * Cette méthode affecte l'ID de la page facebook.
     * @param string $page_id L'ID de la page facebook.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setPageID(string $page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * Cette méthode affecte l'ID de l'application.
     * @param string $app_id L'ID de l'application.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setAppID(string $app_id)
    {
        $this->app_id = $app_id;
    }

    /**
     * Cette méthode affecte la clé de l'application.
     * @param string $app_key La clé de l'application. 
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setAppKey(string $app_key)
    {
        $this->app_key = $app_key;
    }

}