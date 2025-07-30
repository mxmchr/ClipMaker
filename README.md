# ClipMaker

ClipMaker est une application web développée en PHP qui permet de créer facilement des clips vidéo à partir de fichiers existants. Grâce à une interface simple, vous pouvez réaliser, télécharger et visionner vos clips et captures vidéo en toute simplicité. Cet outil s’appuie sur FFMpeg pour le traitement vidéo et utilise une base de données MySQL pour gérer les clips créés.


## Installation

1. Cloner le répertoire :
   ```bash
   git clone https://github.com/mxmchr/ClipMaker.git
   cd ClipMaker
   ```
2. Installer les dépendances avec Composer
   ```bash
   composer install
   ```
3. Créer la base de données
	```bash
	mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS clipmaker;"
	```
3. Créer la base de données
	```bash
	mysql -u root -p root clipmaker < import.sql
	```	
	


## Configuration
Modifiez les paramètres de connexion à la base de données dans le fichier Config.php si nécessaire.

## Utilisation
Accédez à l'application depuis le navigateur.
Créez des clips et des captures en utilisant les fonctionnalités disponibles.

## Prérequis
PHP 7.0 ou version ultérieure
Composer
FFMpeg installé sur le système

## Structure du Répertoire
app: Contient le code de l'application.
public: Contient les fichiers publics accessibles depuis le navigateur.
vendor: Contient les dépendances installées par Composer.
db-scripts: Contient les scripts SQL pour la base de données.
depot: les fichiers video, clips, et captures y seront stoqués.


Auteur
[Maxime Chretien]
