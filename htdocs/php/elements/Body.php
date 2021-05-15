<?php

declare(strict_types = 1);

/**
 * Classe représentant le body de la page html.
 * @type body
 * @brief Classe représentant le body de la page html.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Body extends HTMLContent
{

    private array $scripts;
    private array $modules;

    /**
     * Constructeur de la classe Body.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->scripts = array();
        $this->modules = array();
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateHtml() : string
    {
        for($i = 0; $i < sizeof($this->modules); $i++)
        {
            $this->appendHtml(<<<HTML
                <script src="{$this->modules[$i]}" type="module"></script>\n
            HTML);
        }
        for($i = 0; $i < sizeof($this->scripts); $i++)
        {
            $this->appendHtml(<<<HTML
                <script src="{$this->scripts[$i]}"></script>\n
            HTML);
        }
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
        for($i = 0; $i < sizeof($this->modules); $i++)
        {
            $this->appendHtml(<<<HTML
                <script src="{$this->modules[$i]}" type="module"></script>\n
            HTML);
        }
        for($i = 0; $i < sizeof($this->scripts); $i++)
        {
            $this->appendHtml(<<<HTML
                <script src="{$this->scripts[$i]}"></script>\n
            HTML);
        }
        return $this->html;
    }

    /**
     * Cette méthode ajoute un script javascript à la fin du body
     * @param string $script L'url du script javascript à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addScript(string $script)
    {
        array_push($this->scripts, $script);
    }

    /**
     * Cette méthode ajoute un module javascript à la fin du body
     * @param string $script L'url du module javascript à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addModule(string $module)
    {
        array_push($this->modules, $module);
    }

}