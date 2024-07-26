# Aide symfony

## Création du projet
Créer le projet : `symfony --version 6.3 --webapp new symfony-contacts`
Lancer le serveur local : `symfony serve`

## Travailler

Créer nouveau controller : `bin/console make:controller Hello`
Créer une nouvelle entitée : `bin/console make:entity`

## Intéragir avec la BD

Mettre `DATABASE_URL="mysql://u739936168_vill069:Admin667caca@193.203.168.80:3306/u739936168_SFmain?serverVersion=10.11.8-MariaDB&charset=utf8"` dans le .env pour faire le lien à la BD
Pour créer une nouvelle table :
- Créer une entitée
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`
