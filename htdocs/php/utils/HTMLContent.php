<?php

declare(strict_types = 1);

/**
 * Classe abstraite représentant un element HTML.
 * Un element HTML possède un code html et un identifiant.
 * L'identifiant va permettre aux elements de modfier leurs contenu
 * à l'aide de la page administrateur.
 * @type html-content
 * @brief Classe abstraite représentant un conteneur HTML.
 * @author Alexandre Pierret
 * @version 1.0
 */
abstract class HTMLContent
{
    
    protected string $html;
    protected int $id;
    
    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    protected abstract function onCreateHtml();

    /**
     * Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    protected abstract function onCreateAdminHtml();

    /**
     * Constructeur de classe HTMLContent.
     * Il initialise par défaut l'identifiant du conteneur HTML à -1.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        $this->id = -1;
        $this->html = "";
    }

    /**
     * Cette méthode permet d'ajouter du contenu HTML à l'élement.
     * @brief Cette méthode permet d'ajouter du contenu HTML à l'élement.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function appendHtml(string $content)
    {
        $this->html .= $content;
    }

    /**
     * Cette méthode affecte l'identifiant du conteneur HTML.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setID(int $id)
    {
        $this->id = $id;
    }

    /**
     * Cette méthode renvoie le code HTML utlisateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getHtml() : string
    {
        return $this->onCreateHtml();
    }

    /**
     * Cette méthode renvoie le code HTML administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getAdminHtml()
    {
        return $this->onCreateAdminHtml();
    }

    /**
     * Cette méthode renvoie l'identifiant du conteneur HTML.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getID() : int
    {
        return $this->id;
    }

}