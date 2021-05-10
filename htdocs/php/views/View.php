<?php

declare(strict_types = 1);

require_once("php/utils/Configuration.php");
require_once("php/utils/HTMLContent.php");
require_once("php/elements/Head.php");
require_once("php/elements/Body.php");

/**
 * Classe permettant de créer et manipuler la vue d'une page web.
 * Elle hérite de HTMLContent et possède obligatoirement un Head un body
 * puis un tableau de HTMLContent pour le contenu de la page web.
 * @brief Classe permettant de créer et manipuler une page web.
 * @author Alexandre Pierret
 * @version 1.0
 */
abstract class View
{
    
    private Head $head;
    private Body $body;
    private string $file;
    private string $template;
    private array $json;
    private array $contents;

    /**
     * Cette méthode abstraite permet d'afficher la vue à l'utilisateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public abstract function render();

    /**
     * Constructeur de la classe WebPage.
     * Initialise le head (avec "title" comme titre par défaut) et le body de la page.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        $this->template = Configuration::getConfiguration("template");
        $this->head = new Head("Title");
        $this->body = new Body();
        $this->contents = array();
        $this->html = "";
    }

    /**
     * Cette méthode charge les conteneurs HTML d'un fichier json.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function loadContents(string $file)
    {
        $this->file = $file;
        $this->json = json_decode($this->file, true);
        foreach ($this->json as $key => $data) 
        {
            $id = $key;
            $type = $data["type"];
            if($type != "head") 
            {
                $class = ClassUtils::getClassWithType($type);
                $content = ClassUtils::invokeStaticMethod($class, "loadFromJSON", $data);
                $content->setID($id);
                array_push($this->contents, $content);
            } else {
                $this->head->setTitle($data["title"]);
            }
        }
    }

    /**
     * Cette méthode charge les fichiers css dans le dossier donné en paramètre.
     * @param string $directory Le nom du dossier qui contient les fichiers css demandés.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function loadCssFiles(string $directory)
    {
        $styles = array_diff(scandir($directory, SCANDIR_SORT_NONE), [".", ".."]);
        foreach ($styles as $key => $value) 
        {
            $this->head->addStyle($directory."/".$value);
        }
    }

    /**
     * Cette méthode charge les fichiers javascript dans le dossier donné en paramètre.
     * @param string $directory Le nom du dossier qui contient les fichiers javascript demandés.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function loadJsFiles(string $directory)
    {
        $scripts = array_diff(scandir($directory, SCANDIR_SORT_NONE), [".", ".."]);
        foreach ($scripts as $key => $value) 
        {
            $this->body->addScript($directory."/".$value);
        }
    }
    
    /**
     * Cette méthode permet d'affecter le template CSS utilisé par la page.
     * @param string $template Le nom du template CSS à utiliser.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    /**
     * Cette méthode renvoie le head de la page web.
     * @return Head Le head de la page web.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getHead() : Head
    {
        return $this->head;
    }

    /**
     * Cette méthode renvoie le body de la page web.
     * @return Body Le body de la page web.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getBody() : Body
    {
        return $this->body;
    }

    /**
     * Cette méthode renvoie le nom du fichier json de la vue.
     * @return string Le nom du fichier json de la vue.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getFile() : string
    {
        return $this->file;
    }

    /**
     * Cette méthode renvoie le nom du template associé à la vue.
     * @return string Le nom du template associé à la vue.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getTemplate() : string
    {
        return $this->template;
    }

    /**
     * Cette méthode renvoie le contenu du fichier json de la vue sous forme de tableau.
     * @return array Le contenu du fichier json de la vue sous forme de tableau.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getJson() : array
    {
        return $this->json;
    }

    /**
     * Cette méthode renvoie la liste des conteneurs HTML de la page.
     * @return array La liste des conteneurs HTML de la page.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getContents() : array
    {
        return $this->contents;
    }

}