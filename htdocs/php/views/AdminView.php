<?php

require_once("php/views/View.php");

/**
 * Classe représentant la vue administrateur.
 * @type navbar
 * @brief Classe représentant la vue administrateur.
 * @author Alexandre Pierret
 * @version 1.0
 */
class AdminView extends View
{

    /**
     * Classe permettant de créer et manipuler la vue de la page administrateur.
     * Elle hérite de View qui est la classe mère pour manipuler une page web.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadCssFiles("templates/".$this->getTemplate()."/website");
        $this->loadCssFiles("templates/".$this->getTemplate()."/administration");
        $this->loadJsFiles("js/administration");
    }

    /**
     * Cette méthode abstraite permet d'afficher la vue à l'utilisateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function render()
    {
        $area = FrontController::getInstance()->getArea();

        $this->getBody()->appendHtml(<<<HTML
            <button class="add-button" target="container" target-id="1">Ajouter un élement</button>
        HTML);

        for($i = 0; $i < sizeof($this->getContents()); $i++)
        {
            $index = $i + 2;
            $this->getBody()->appendHtml(<<<HTML
                {$this->getContents()[$i]->getAdminHtml()}
                <button class="add-button" target="container" target-id="{$index}">Ajouter un élement</button>
            HTML);
        }

        echo(<<<HTML
            <!doctype html>
            <html lang="fr">
            <head>
            {$this->getHead()->getAdminHtml()}
            </head>
            <body>
            {$this->getNavbar()}
            <div class="element-container">
            <div class="element-title">Titre de la page</div>
            <div class="element-manager-2">
            <input role="admin" type="head" id="0" target="title" value="{$this->getHead()->getTitle()}">
            </div>
            </div>
            {$this->getBody()->getAdminHtml()}
            {$this->getImageModal()}
            {$this->getUrlModal()}
            {$this->getContainerModal()}
            <div id="json" url="webpage/{$area}.json" hidden>
            {$this->getFile()}
            </div>
            </body>
            </html>
        HTML);
    }

    private function getNavbar() : string
    {
        $pages = FrontController::getInstance()->getPages();

        $html = <<<HTML
            <div class="navbar-administration">
            <div class="navbar-line">\n
        HTML;

        for($i = 0; $i < sizeof($pages); $i++)
        {
            $html .= <<<HTML
                <div class="navbar-button-administration bg-white">{$pages[$i]}</div>
            HTML;
        }

        $html .= <<<HTML
            </div>
            <div class="navbar-line">
            <div class="navbar-button-save-administration" id="button-save">Sauvegarder la page</div>
        HTML;

        if(isset($_GET["area"]) && $_GET["area"] != "index")
        {
            $html .= <<<HTML
                <div class="navbar-button-delete-administration" id="button-delete">Supprimer cette page</div>
            HTML;
        }

        $html .= <<<HTML
            <div class="navbar-button-quit-administration" id="button-home">Retour au site</div>
            <div class="navbar-button-disconnect-administration" id="button-disconnect">Déconnexion</div>
            <div class="navbar-button-create-administration" id="button-create">Créer une page</div>
            <input class="navbar-create-input" type="text" placeholder="Nom de la nouvelle page">
            </div>
            </div>
        HTML;

        return $html;
    }

    private function getImageModal() : string
    {
        $html = <<<HTML
            <div class="modal-admin" id="modal-image-admin">
            <div class="modal-content">
            <div class="modal-image-content">
        HTML;

        foreach (array_diff(scandir("content/images"), [".", ".."]) as $key => $value) 
        {
            $html .= <<<HTML
            <div class="modal-container-content">
            <img class="modal-image" src="content/images/{$value}" width=100px height=100px>
            <div class="delete-image-button" image="{$value}">Supprimer</div>
            </div>
            HTML;
        }

        $html .= <<<HTML
            </div>
            <div class="modal-button-content">
            <input class="modal-add-button" type="file">
            <div class="modal-close-button">Retour</div>
            </div>
            </div>
            </div>
        HTML;

        return $html;
    }

    private function getUrlModal() : string
    {
        $pages = FrontController::getInstance()->getPages();

        $html = <<<HTML
            <div class="modal-admin" id="modal-url-admin">
            <div class="modal-content">
            <div class="modal-url-content">
        HTML;

        for($i = 0; $i < sizeof($pages); $i++)
        {
            $html .= <<<HTML
                <div class="modal-url" value="{$pages[$i]}">{$pages[$i]}</div>
            HTML;
        }

        $html .= <<<HTML
            </div>
            <div class="modal-button-content">
            <div class="modal-close-button">Retour</div>
            </div>
            </div>
            </div>
        HTML;

        return $html;
    }

    private function getContainerModal() : string
    {
        $containers = ClassUtils::getAllContainerClasses();

        $html = <<<HTML
            <div class="modal-admin" id="modal-container-admin">
            <div class="modal-content">
            <div class="modal-container-content">
        HTML;

        foreach ($containers as $key => $value) 
        {
            $name = ClassUtils::getContainerName($value);
            $html .= <<<HTML
                <div class="modal-container" value={$value}>{$name}</div>
            HTML;
        }

        $html .= <<<HTML
            </div>
            <div class="modal-button-content">
            <div class="modal-close-button">Retour</div>
            </div>
            </div>
            </div>
        HTML;

        return $html;
    }

}