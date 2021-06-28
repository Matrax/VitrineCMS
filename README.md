# Explications de VitrineCMS

## Technologies
PHP 8.0 / JavaScript / CSS

## Dossiers
Le dossier htdocs contient le contenu public de votre site web.
Le dossier webpage contient les pages de votre site web sous format JSON.
Le dossier documentation contient une documentation générée sous Doxygen du code PHP.
Le dossier Uml contient une représentation sous forme de diagramme des classes PHP.
Le fichier Configuration Json contient les configurations du site web.

## Description
Il s'agit d'un CMS français conçu pour la création de sites vitrine, configurable facilement par un développeur ou un simple utilisateur.
VitrineCMS est conçu pour être évolutif, un développeur peut créer ses propres conteneurs HTML facilement pour apporter de l'originalité aux sites qu'il développe.
Mais VitrineCMS est aussi conçu pour qu'un utilisateur ne sachant pas programmer puisse concevoir son site ou apporter des modifications après son

## Fonctionnement
Le CMS utilise le système de contrôleur de vue (FrontController.php).
C'est-à-dire que le site n'est composé que d'un seul point d'entrer (index .php), et selon les paramètres GET entrés, le contrôleur de vue va s'adapter pour afficher la bonne vue à l'utilisateur avec le bon rôle (utilisateur ou administrateur)
Lorsqu'un utilisateur effectue une requête au site pour avoir la vue au script index .php, le contrôleur de vue fait appel au dispatcher

## Demander une vue
L'utilisateur demande une vue en faisant une requête à l'aide du lien
{domaine}/index.php. (ou simplement avec le nom de domaine, le serveur
web appellera index.php automatiquement)
L'utilisateur peut préciser la page du site qu'il souhaite accéder
avec {domaine}/index.php?area={page}. Le dispatcher se chargera
de générer la vue utilisateur avec la page demandé, puis
le contrôleur de vue en fera l'affichage.
<br>
Si l'utilisateur souhaite basculer sur la vue administratrice de la page pour effectuer des modifications sur le contenu de la page, l'utilisateur doit ajouter le rôle dans le lien avec {domaine}/index.php?area={page}&role={admin}.
Par défaut, si aucune page n'est spécifiée dans le lien, la page index sera demandé. Et si aucun rôle n'est spécifié, la vue utilisateur sera demandée.

## Vue administrateur
Pour accéder à la vue "administrateur" d'une page, une connexion est demandée.
La connexion demande le login précisé dans le fichier de configuration et le mot de passe crypté en sha512. Le mot de passe entré dans le fichier de configuration doit être en sha512 uniquement.
<br>
Login par défaut: login
Mot de passe par défaut: password