# VitrineCMS (1.0)

## Description (pour les développeurs et utilisateurs)
Il s'agit d'un CMS français développé pour la création de sites vitrine.
VitrineCMS est facilement configurable par un développeur ou par un simple utilisateur.
L'avantage est que VitrineCMS possède une partie administration qui permet aux utilisateurs ne sachant pas programmer
de configurer tout les élements de chaque pages du site web.

## Technologies (pour les développeurs)
VitrineCMS utilise la puissance de PHP 8.0 coté back-end et JavaScript coté front-end.

## Installation
Un git clone suffit, placez ensuite les fichiers récupérés dans le repertoire de votre serveur web.

## Dossiers (pour les développeurs)
Fichiers/Dossiers | Utilisations
------------ | -------------
htdocs | Contient le contenu public de votre site web.
webpage | Contient les pages de votre site web sous format JSON.
documentation | Contient une documentation générée sous Doxygen du code PHP.
configuration.json | Contient la configuration du site vitrine.

## Fonctionnement (pour les développeurs)
Le CMS utilise le système de contrôleur de vue (FrontController.php, View.php, Dispatcher.php),
c'est-à-dire que le site web n'est composé que d'un seul point d'entrée (index .php), et selon les paramètres "GET", le contrôleur de vue va s'adapter
pour afficher la bonne vue à l'utilisateur avec le bon rôle (utilisateur ou administrateur).
<br><br>
Le serveur va donc à l'aide de la partie PHP récupérer les informations de la page demandé par l'utilisateur dans le fichier JSON correspondant à la page.
Ce fichier JSON trouvé contiendra tout les élements de la page, puis le serveur génerera à partir de ces informations la page HTML
envoyer à l'utilisateur.
<br><br>
Ce CMS est conçu pour être évolutif, un développeur peut créer ses propres conteneurs HTML facilement pour apporter des élements nouveaux à son site,
pour cela, le développeur doit créer une nouvelle classe dans le dossier htdocs/php/elements, la faire hériter de HTMLContent.php
et de redéfinir les méthodes onCreateHtml() et onCreateAdminHtml(). VitrineCMS s'occupera automatiquement de l'ajout de ce nouveau élement dans le CMS.

## Vue administrateur (pour les développeurs et utilisateurs)
Login par défaut: login
<br>
Mot de passe par défaut: password
