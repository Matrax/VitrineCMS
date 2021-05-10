<?php

declare(strict_types = 1);

/**
 * Classe représentant le head de la page html.
 * @type head
 * @brief Classe représentant le head de la page html.
 * @author Alexandre Pierret
 * @version 1.0
 */
class Head extends HTMLContent
{

    private string $title;
    private string $author;
    private string $charset;
    private array $styles;

    /**
     * Constructeur de la classe Head.
     * @brief Constructeur de la classe Head.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct(string $title)
    {
        parent::__construct();
        $this->title = $title;
        $this->charset = "utf-8";
        $this->description = "";
        $this->keywords = "";
        $this->author = "Alexandre Pierret";
        $this->styles = array();
        $this->id = 0;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @brief Cette méthode abstraite permet de crée le contenu html utilisateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateHtml() : string
    {
        $this->appendHtml("<meta charset=\"".$this->charset."\">");
        $this->appendHtml("<meta name=\"keywords\" content=\"".$this->keywords."\">");
        $this->appendHtml("<meta name=\"author\" content=\"".$this->author."\">");
        $this->appendHtml("<meta name=\"description\" content=\"".Configuration::getConfiguration("description")."\">");
        $this->appendHtml("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");
        $this->appendHtml("<meta http-equiv=\"Cache-control\" content=\"public\">");
        $this->appendHtml("<title>".$this->title."</title>");
        for($i = 0; $i < sizeof($this->styles); $i++)
        {
            $this->appendHtml("<link rel=\"stylesheet\" href=\"".$this->styles[$i]."\">");
        }
        return $this->html;
    }

    /**
     * Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @return string Le contenu html administrateur du conteneur.
     * @brief Cette méthode abstraite permet de crée le contenu html administrateur du conteneur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function onCreateAdminHtml() : string
    {
        $this->appendHtml("<meta charset=\"".$this->charset."\">");
        $this->appendHtml("<meta name=\"keywords\" content=\"".$this->keywords."\">");
        $this->appendHtml("<meta name=\"author\" content=\"".$this->author."\">");
        $this->appendHtml("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");
        $this->appendHtml("<title>".$this->title." Administration</title>");
        for($i = 0; $i < sizeof($this->styles); $i++)
        {
            $this->appendHtml("<link rel=\"stylesheet\" href=\"".$this->styles[$i]."\">");
        }
        return $this->html;
    }

    public function addStyle(string $style)
    {
        array_push($this->styles, $style);
    }

    public function setTitle(string $title)
    {
        if($title == null) throw new Exception("Can't set null title to the head");
        $this->title = $title;
    }

    public function setCharset(string $charset)
    {
        if($charset == null) throw new Exception("Can't add null charset to the head");
        $this->charset = $charset;
    }

    public function setAuthor(string $author)
    {
        if($author == null) throw new Exception("Can't add null author to the head");
        $this->author = $author;
    }

    public function setLanguage(string $language)
    {
        if($language == null) throw new Exception("Can't add null language to the head");
        $this->language = $language;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

}