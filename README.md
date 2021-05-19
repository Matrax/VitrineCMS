# Explications de VitrineCMS

## Technologies
PHP 8.0 / JavaScript / CSS

## Dossiers
Le dossier htdocs contient le contenu publique de votre site web.
Le dossier webpage contient les pages de votre site web sous format JSON.
Le dossier documentation contient une documentation généré sous Doxygen du code PHP.
Le dossier uml contient une réprésentation sous forme de diagramme des classes PHP.
Le fichier Configuration.json contient les configurations du site web.

## Description
Il s'agit d'un CMS français conçu pour la création de site vitrine, configurable
facilement par un développeur ou un simple utilisateur.
VitrineCMS est conçu pour être évolutif, un développeur
peut créer ses propre conteneurs HTML facilement pour apporter 
de l'originalité aux sites qu'il développe.
Mais VitrineCMS est aussi conçu pour qu'un utilisateur ne sachant 
pas programmer puisse concevoir son site ou apporter
des modifications après son développement à l'aide de la page
administrateur sans avoir l'expertise d'un développeur.

## Fonctionnement
Le CMS utilise le système de controlleur de vue (FrontController.php).
C'est à dire que le site n'est composé que d'un seul
poit d'entrer (index.php), et selon les paramètres GET
entrés, le controlleur de vue va s'adapter pour afficher
la bonne vue à l'utilisateur avec le bon rôle (utilisateur ou administrateur)
Lorsqu'un utilisateur effectue une requête au site pour avoir la vue 
au script index.php, le controlleur de vue fait appel au dispatcher (Dispatcher.php)
qui va générer la vue démandé par l'utilisateur (vue utilisateur ou vue administrateur).
Chaque page du site est sauvegardé sous format JSON pour faciliter sa
modification ou sa récupération par le dispatcher car le JSON est un format
très rapide à écrire ou lire et se veut plus compacte que d'autre
format (HTML ou XML par exemple).

## Demander une vue
L'utilisateur demande une vue en faisant une requête à l'aide du lien
{domaine}/index.php. (ou simplement avec le nom de domaine, le serveur
web appellera index.php automatiquement)
L'utilisateur peut préciser la page du site qu'il souhaite accéder
avec {domaine}/index.php?area={page}. Le dispatcher se chargera
de générer la vue utilisateur avec la page demandé, puis
le front controller en fera l'affichage.
Si l'utilisateur souhaite basculer sur la vue administrateur de la page
pour éffectuer des modifications sur le contenu de la page,
l'utilisateur doit ajouter le rôle dans le lien avec
{domaine}/index.php?area={page}&role={admin}.
Par défaut, si aucune page n'est spécifié dans le lien, la page
index sera demandé. Et si aucun role n'est spécifié, la vue
utilisateur sera demandé.

## Vue administrateur
Pour accéder à la vue administrateur d'une page, une connexion est demandé.
La connexion demande le login précisé dans le fichier de configuration
et le mot de passe crypté en sha512. Le mot de passe entré dans le fichier 
de configuration doit être en sha512 uniquement.