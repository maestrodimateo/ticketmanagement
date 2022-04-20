# Application de gestion de tickets
Cette application a pour but de permettre aux fonctionnels de créer des tickets à la suite d'un problème technique afin que les personnes abilités puisse visualiser afin de resoudre ces problemes et enfin leur notifier que le problème a été résolu

## Installation

- ### Pré-requis
Pour installer cette application vous devez avoir : 
1. Apache
2. php 7.4 ou plus
3. Mysql ou Maria DB
4. Composer -> c'est un gestionnaire de dépendances

- ### Manipulation à effectuer
Après avoir télécharger le zip sur github vous devez effectuer ces actions pour que l'application fonctionne.
1. Renommer le fichier *.env.example* en *.env*
2. Renseigner les informations nécessaires qui sont dans le fichier *.env* en question
3. Grace à *composer* installer les dépendance en tapant __composer install__ dans le terminal (en étant dans le dossier du projet)
4. Créer un virtualhost pour le projet
