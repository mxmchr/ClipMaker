<?php

// Inclure les fichiers nécessaires
require_once './app/controllers/HomeController.php'; // Assurez-vous que HomeController.php existe dans le dossier "controllers"
require_once './app/models/HomeModel.php'; // Assurez-vous que HomeModel.php existe dans le dossier "models"

// Récupérer l'URL demandée

$request_uri = $_SERVER['REQUEST_URI'];

// Retirer le slash initial s'il existe
$request_uri = ltrim($request_uri, '/');

// Diviser l'URL en segments
$segments = explode('/', $request_uri);

// Déterminer le contrôleur et l'action en fonction des segments d'URL
$controller = (isset($segments[0]) && !empty($segments[0])) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
$action = (isset($segments[1]) && !empty($segments[1])) ? $segments[1] : 'index';

// Vérifier si le fichier du contrôleur existe
$controller_file = "./app/controllers/{$controller}.php";
if (file_exists($controller_file)) {
    require_once $controller_file;

    // Instancier le contrôleur
    $controller_instance = new $controller();

    // Vérifier si la méthode/action existe dans le contrôleur
    if (method_exists($controller_instance, $action)) {
        // Appeler la méthode/action du contrôleur
        $controller_instance->$action();
    } else {
        // Gérer l'action non trouvée (par exemple, afficher une erreur 404)
        echo "Action non trouvée";
    }
} else {
    // Gérer le contrôleur non trouvé (par exemple, afficher une erreur 404)
    echo "Contrôleur non trouvé";
}

