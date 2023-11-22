<?php
// Récupérer l'URL demandée
$request_uri = $_SERVER['REQUEST_URI'];

// Retirer le slash initial s'il existe
$request_uri = ltrim($request_uri, '/');

// Diviser l'URL en segments
$segments = explode('/', $request_uri);

// Déterminer le contrôleur et l'action en fonction des segments d'URL
$controller = (isset($segments[0]) && !empty($segments[0])) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
$action = (isset($segments[1]) && !empty($segments[1])) ? $segments[1] : 'index';
$param = (isset($segments[2]) && !empty($segments[2])) ? $segments[2] : null;

// Vérifier si le fichier du contrôleur existe
$controller_file = "./app/Controllers/{$controller}.php";
if (file_exists($controller_file)) {

    // Instancier le contrôleur
    $fqn=NAMESPACE_CONTROLLER . $controller;
    $controller_instance = new $fqn();

    // Vérifier si la méthode/action existe dans le contrôleur
    if (method_exists($controller_instance, $action)) {
        // Appeler la méthode/action du contrôleur avec les paramètres
        $controller_instance->$action($param);
    }  else {
        // Gérer l'action non trouvée (par exemple, afficher une erreur 404)
        require_once './app/templates/404.php';
    }
} else {
    // Gérer le contrôleur non trouvé (par exemple, afficher une erreur 404)
    require_once './app/templates/404.php';
}


