# Documentation du projet 
Ce document fournit des instructions pour mettre en place et utiliser l'application de gestion de vente d'animaux


# Mise en Place de l'Application

 1. Clonage du Répertoire

Clonez le répertoire du projet depuis GitHub :

`git clone https://github.com/raphou89/mink.git`

 2. Installation des Dépendances

`cd farm`
`npm install`

Ceci va intaller toutes les dépendances présente dans le fichier `package.json`

3. Migration et Seed


`php composer install`

Ensuite il faut créer un fichier .env à la racine du projet. Pour la syntaxe, se baser sur le fichier .env.example
`php artisan migrate`
`php artisan db:seed`

Les migrations et les seeders permettent de structurer les données au sein de la base de données ainsi que de la remplir. La base de données est celle de base de laravel.

Assurez vous d'avoir une application qui lit les .sqlite si vous voulez voir le contenu de la bdd

4. Lancement de l'application 

Deux terminaux seront necessaires : 

Dans le premier, on va gérer les dépendances du front donc de vueJS. Pour ce faire, on va lancer la commande 
`npm i && npm run dev`

Cela va initier vite et toutes les liaisons notamment avec tailwind

Dans le deuxième terminal, on lance la commande 

`php artisan serve`

Si artisan n'est pas installer dans le dossier, vous devez également l'installer. Pour se faire, simplement un 
`composer install`.

L'application sera accessible à l'adresse `http://localhost:8000` par défaut.


# Temps Passé sur le Développement

Le temps total consacré au développement de cette application est d'environ 7 heures.

# Technologies Utilisées

-   **Frontend :**  Vue.js, Tailwind CSS
-   **Backend :**  Laravel
-   **Base de Données :**  SQLite (fichier database.sqlite)