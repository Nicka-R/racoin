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

## Troisième étape - La maintenance

### Mises à jour effectuées

- **PHP** : Passage de la version 7.4 à 8.4 dans le Dockerfile pour bénéficier du support et des performances améliorées.
- **Slim** : Passage de la version 2.x à 4.x dans `composer.json` (`"slim/slim": "^4.0"`), adaptation du code pour la compatibilité.
- **Twig** : Passage à la version 3.x (`"twig/twig": "^3.0"`), remplacement de tous les `loadTemplate()` par `render()`.
- **illuminate/database** : Passage à la version 10.x (`"illuminate/database": "^10.0"`).
- **slim/psr7** : Ajout pour compatibilité avec Slim 4.

### Problèmes rencontrés et corrections

- **Twig** : Ancienne utilisation de `loadTemplate()` remplacée par `render()` pour compatibilité avec Twig 3.
- **Slim** : Les routes définies avec ou sans slash final provoquaient des erreurs 404. Harmonisation des routes dans `index.php` pour éviter les erreurs.
- **Compatibilité PHP 8** : Vérification de la compatibilité du code avec PHP 8 (types, fonctions dépréciées, etc.).
- **Autoloading** : Vérification de la configuration PSR-0 dans `composer.json` 
- **Sécurité** : Utilisation de `password_hash` et `password_verify` pour les mots de passe, échappement des entrées utilisateurs avec `htmlentities`.
- **Gestion des erreurs** : Ajout de messages d’erreur explicites pour les routes non trouvées et les formulaires invalides.

| Idée d'amélioration                                 | Temps (sur 10) | Impact (sur 10) |
|-----------------------------------------------------|:--------------:|:---------------:|
| Passer l’autoloading de PSR-0 à PSR-4               |       3        |        7        |
| Ajouter des tests unitaires (PHPUnit)               |       6        |        8        |
| Mettre à jour jQuery et vérifier les dépendances JS |       2        |        5        |
| Ajouter une CI (GitHub Actions) pour les tests      |       4        |        7        |
| Sécuriser les uploads de fichiers                   |       5        |        8        |
| Ajouter la pagination sur la liste des annonces     |       4        |        6        |
| Refactoriser les contrôleurs pour plus de clarté    |       5        |        7        |
| Ajouter une gestion des erreurs centralisée         |       4        |        7        |
| Améliorer l’accessibilité et le responsive          |       3        |        6        |
| Ajouter une API REST pour les annonces              |       7        |        8        |
