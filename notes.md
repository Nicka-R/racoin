# Etude de projet

## Première étape - L'analyse

### Langages utilisés:

- PHP
- SCSS
- Twig
- JavaScript
- SQL (MySQL)

### Framework utilisé:

- Symfony

### But général de l'application:

- Créer un site de petites annonces

### Première estimation de ce qu'il faut pour faire marcher l'application

- Lancement du conteneur
- Installation des dépendances
- Configuration de la base de données
- Population de la base de données

## Deuxième étape - La prise en main

### Problèmes rencontrés :

- Problème de connexion à la base de données : j'ai crée un service mysql et adminer pour gérer les données. J'ai renseigné `MYSQL_DATABASE` et `MYSQL_ROOT_PASSWORD`sur la base de données dans le fichier .env  
  J'ai crée le fichier ./config/config.ini avec les informations de connexion à la base de donnée avec le `driver`, `host`, `dbname`, `username`, `password` et `charset`.
- J'ai centralisé les fichiers `.sql` dans le dossier `./sql`
- Table sous-catégorie non créée dans `./sql/insert.sql`
- loadTemplate() ne fonctionne pas donc j'ai mis render()

### Mode d'emploi pour faire marcher l'application

- Voir le fichier `README.md`

### Dépendances non maintenues

- La version de PHP est obsolète dans le Dockerfile, on le passe de `7.4` à `8.4` d'après le site des versions de PHP : https://www.php.net/supported-versions.php

- La version 2.6.3 de Slim est un peu ancienne, mais elle ne présente pas de faille de sécurité connue. On peut tout de même utiliser une version plus récente comme la v4.0 et dans la conteneur on installe `composer require slim/psr7`

- La version v1.44.8 de Twig est obsolète, on la passe à une version plus récente.

- La version de illuminate/database est ancienne, on peut utiliser une version plus récente.

- La version de jQuery est assez ancienne, mais s'il faut prioriser les mises à jour, on peut faire la MAJ de la version de PHP en premier.
