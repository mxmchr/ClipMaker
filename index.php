<?php

// Appel de l'autoload pour l'utilisation des packages Composer
require './vendor/autoload.php';

// Définition de la constante ABSPATH qui sera utilisée comme chemin relatif par défaut avec '/'
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Définition de la constante utilisée pour appeler les fonctions dont le nom est stocké dans une variable
if (!defined('NAMESPACE_CONTROLLER')) {
    define('NAMESPACE_CONTROLLER', 'Clipmaker\\Controllers\\');
}

// Appel du HTML commun à toutes les pages
include './app/templates/header.php';

// Permet le routage des URL
require_once './app/Router.php';

// Appel du HTML commun à toutes les pages
include './app/templates/footer.php';
