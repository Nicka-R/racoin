# Racoin

## Description

Site de petites annonces développé avec Symfony

## Mode d'emploi

1. Cloner le projet
2. Se placer à la racine du projet
3. Créer un fichier `.env` à la racine du projet en prenant exemple sur le fichier `.env example`
4. Créer un fichier ./config/config.ini en prenant exemple sur le fichier .empty
5. Builder les conteneurs avec la commande `docker compose build ./docker/php`
6. Lancer les conteneurs avec la commande `docker compose up -d`, la base de données sera importée automatiquement au lancement des conteneurs
7. Installer les dépendances avec la commande `docker exec -it racoin-php-1 composer install`
8. Accéder au site à l'adresse `http://localhost:8080`
