<?php

//appel de l'autoload pour l'utilisation des packages composer
require './vendor/autoload.php';

//définition de la constante ABSPATH qui sera utiilisé comme chamin relatif par défaut avec '/'
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

//définition de la constante utilisé pour appeler les fonctions dont le nom est stoqué dans une variable
if (!defined('NAMESPACE_CONTROLLER')) {
    define('NAMESPACE_CONTROLLER', 'Clipmaker\\Controllers\\');
}

//appel du html commun à toutes les pages
include './app/templates/header.php';

//Permet le routage des URL
require_once './app/Router.php';

//appel du html commun à toutes les pages
include './app/templates/footer.php';