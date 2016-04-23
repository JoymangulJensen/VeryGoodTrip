# VeryGoodTrip

## Projet ISI-2 Web - Polytech Lyon
Réalisé par Jensen Joymangul et Gaëtan Martin

* Création d'un site e-commerce de voyages
* Architecture MVC et utilisation du micro-framework Silex
* Utilisation de Composer
* Base de données MySQL

## Installation
* Framework
    * Avec composer : (fichier **composer.json**)
```shell
composer install
composer update
```
* Base de données
    * Importer les scripts dans l'ordre suivant :
    1. **database.sql**
    2. **structure.sql**
    3. **content.sql**
    * Ou alors importer directement **verygoodtrip.sql**

## Utilisation
Configurer un hôte virtuel ou alors ouvrir directement <http://localhost/verygoodtrip/web/index.php/>

Des utilisateurs sont déjà créés dans la base de données :
* Utilisateur lambda :
    * Identifiant : john@doe.com
    * Password : secret
* Administrateur :
    * Identifiant : admin@admin.com
    * Password  : admin


### Schéma de la base de données utilisée :
![alt text][logo]

[logo]: https://github.com/polytechlyon-isi2/VeryGoodTrip/blob/master/DatabaseDiagrame/diagram.png?raw=true "Image od database diagram"

