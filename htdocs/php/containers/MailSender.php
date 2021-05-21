<?php

declare(strict_types = 1);

/**
 * Classe représentant un panneau d'envoie de mail.
 * @type mail-sender
 * @name Panneau de contact
 * @brief Classe représentant un panneau d'envoie de mail.
 * @author Alexandre Pierret
 * @version 1.0
 */
class MailSender extends HTMLContent
{

    private string $image;
    private array $contacts;

    /**
     * Constructeur de la classe MailSender.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function __construct()
    {
        parent::__construct();
        $this->contacts = array();
        $this->image = "";
    }

    /**
     * Cette fonction permet de charger en php depuis un fichier json 
     * d'une page un objet de la classe correspondante.
     * @param array $data Les données de l'objet à charger
     * @return {La classe ou la fonction est appelée} L'objet chargé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadFromJSON(array $data) : MailSender
    {
        $mailSender = new MailSender();
        $mailSender->setImage($data["image"]);
        foreach ($data["elements"] as $key => $value) 
        {
            $mailSender->addContact($value["name"], $value["mail"]);
        }
        return $mailSender;
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
        $data["type"] = "mail-sender";
        $data["image"] = "content/none.png";
        $data["elements"] = array();
        $data["elements"]["0"]["name"] = "Test";
        $data["elements"]["0"]["mail"] = "test@mail.fr";
        $data["elements"]["1"]["name"] = "Test 2";
        $data["elements"]["1"]["mail"] = "test2@mail.fr";
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
            <form method="post" action="scripts/mail.php" class="mail-sender">
            <img class="mail-image" src="{$this->image}" width=100% height=100%>
            <div class="mail-inputs">
            <select name="destination" class="mail-contacts">
        HTML);

        foreach ($this->contacts as $key => $value) 
        {
            $split = explode(":", $value);
            $name = $split[0];
            $email = $split[1];
            $this->appendHtml(<<<HTML
                <option value="{$email}">{$name}</option>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </select>
            <input name="email" type="email" class="mail-email" placeholder="Ecrivez votre adresse email ici" required>
            <input name="phone" type="tel" class="mail-phone" placeholder="Ecrivez votre numéro de téléphone ici" required>
            <input name="subject" type="text" class="mail-subject" placeholder="Ecrivez l'objet de votre message ici" required>
            <textarea name="content" type="text" class="mail-content" placeholder="Ecrivez votre message ici ..." required></textarea>
            <input class="mail-submit" type="submit" value="Envoyer">
            </div>
            </form>
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
            <form method="post" action="scripts/mail.php" class="mail-sender">
            <img class="mail-image" src="{$this->image}" width=100% height=100%>
            <div class="mail-inputs">
            <select name="destination" class="mail-contacts">
        HTML);

        foreach ($this->contacts as $key => $value) 
        {
            $split = explode(":", $value);
            $name = $split[0];
            $email = $split[1];
            $this->appendHtml(<<<HTML
                <option value="{$email}">{$name}</option>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </select>
            <input name="email" type="email" class="mail-email" placeholder="Ecrivez votre adresse email ici" required>
            <input name="phone" type="tel" class="mail-phone" placeholder="Ecrivez votre numéro de téléphone ici" required>
            <input name="subject" type="text" class="mail-subject" placeholder="Ecrivez l'objet de votre message ici" required>
            <textarea name="content" type="text" class="mail-content" placeholder="Ecrivez votre message ici ..." required></textarea>
            <input class="mail-submit" type="submit" value="Envoyer">
            </div>
            </form>
            </div>
            <div class="element-title">Image</div>
            <div class="element-manager-2">
            <button role="admin" target="image" id="{$this->id}" value="{$this->image}">{$this->image}</button>
            </div>
            <div class="element-title">Adresses</div>
            <div class="element-manager-3">
        HTML);

        foreach ($this->contacts as $key => $value) 
        {
            $split = explode(":", $value);
            $name = $split[0];
            $email = $split[1];
            $this->appendHtml(<<<HTML
                <input role="admin" target="name" container-id="{$this->id}" id="{$key}" value="{$name}">
                <input role="admin" target="mail" container-id="{$this->id}" id="{$key}" value="{$email}">
                <div class="subelement-delete-button" container-id="{$this->id}" id="{$key}">Supprimer le contact</div>
            HTML);
        }

        $this->appendHtml(<<<HTML
            </div>
            <div class="element-title">Options</div>
            <div class="elements-options">
            <div class="subelement-create-button" target="mailsender" container-id="{$this->id}">Ajouter un contact</div>
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

    /**
     * Cette méthode permet d'ajouter un contact
     * @param string $name Le nom du contact
     * @param string $mail L'adresse email du contact
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function addContact(string $name, string $mail)
    {
        array_push($this->contacts, $name.":".$mail);
    }

    /**
     * Cette méthode permet de changer l'image du formulaire
     * @param string $image L'url de l'image à ajouter
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * Cette méthode permet de récupérer la liste des contacts
     * @return array La liste des contacts
     * @author Alexandre Pierret
     * @version 1.0
     */
    public function getContacts() : array
    {
        return $this->contacts;
    }

}