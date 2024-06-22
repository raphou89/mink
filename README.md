# Documentation du projet 
Ce document fournit des instructions pour mettre en place et utiliser l'application de gestion de vente d'animaux


# Mise en Place de l'Application

 1. Clonage du Répertoire

Clonez le répertoire du projet depuis GitHub :

`git clone https://github.com/raphou89/mink.git`

 2. Installation des Dépendances

`cd farm`
`npm install`

Ceci va intaller toutes les dépendances présente dans le fichier `packaje.json`

3. Migration et Seed

`php artisan migrate`
`php artisan db:seed`

Les migrations et les seeders permettent de structurer les données au sein de la base de données ainsi que de la remplir. La base de données est celle de base de laravel. Vous pouvez la trouver en suivant ce chemin d'accès : `database/database.sqlite`.

Assurez vous d'avoir une application qui lit les .sqlite si vous voulez voir le contenu de la bdd

4. Lancement de l'application 

`php artisan serve`

L'application sera accessible à l'adresse `http://localhost:8000` par défaut.

Ce projet 


# Temps Passé sur le Développement

Le temps total consacré au développement de cette application est d'environ 7 heures.

# Technologies Utilisées

-   **Frontend :**  Vue.js, Tailwind CSS
-   **Backend :**  Laravel
-   **Base de Données :**  SQLite (fichier database.sqlite)