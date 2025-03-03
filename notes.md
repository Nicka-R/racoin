# Etude de projet

## Première étape - L'analyse

Langages utilisés:

- PHP
- SCSS
- Twig
- JavaScript
- SQL (MySQL)

Framework utilisé:

- Symfony

But général de l'application:

- Créer un site de petites annonces

Première estimation de ce qu'il faut pour faire marcher l'application

- Lancement du conteneur
- Installation des dépendances
- Configuration de la base de données
- Population de la base de données

Problèmes rencontrés :

- Problème de connexion à la base de données : j'ai crée un service mysql et adminer pour gérer les données. J'ai renseigné `MYSQL_DATABASE` et `MYSQL_ROOT_PASSWORD`sur la base de données dans le fichier .env  
  J'ai crée le fichier ./config/config.ini avec les informations de connexion à la base de donnée avec le `driver`, `host`, `dbname`, `username`, `password` et `charset`.
- J'ai centralisé les fichiers `.sql` dans le dossier `./sql`
- Table sous-catégorie non créée dans `./sql/insert.sql`
