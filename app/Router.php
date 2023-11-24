<?php
// Récupérer l'URL demandée
$request_uri = $_SERVER['REQUEST_URI'];

// Retirer le slash initial s'il existe
$request_uri = ltrim($request_uri, '/');

// Diviser l'URL en segments
$segments = explode('/', $request_uri);

// Déterminer le contrôleur¿l'action, et le paramètre en fonction des segments d'URL
$controllerName = (isset($segments[0]) && !empty($segments[0])) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
$action = (isset($segments[1]) && !empty($segments[1])) ? $segments[1] : 'index';
$param = (isset($segments[2]) && !empty($segments[2])) ? $segments[2] : null;

// Chemin du fichier du contrôleur
$controllerFile = "./app/Controllers/{$controllerName}.php";

if (file_exists($controllerFile)) {
    // Instancier le contrôleur
    $controllerClassName = NAMESPACE_CONTROLLER . $controllerName;
    $controllerInstance = new $controllerClassName();

    // Vérifier si la méthode/action existe dans le contrôleur
    if (method_exists($controllerInstance, $action)) {
        // Appeler la méthode/action du contrôleur avec les paramètres
        $controllerInstance->$action($param);
    }  else {
        // Gérer l'action non trouvée (par exemple, afficher une erreur 404)
        require_once './app/templates/404.php';
    }
} else {
    // Gérer le contrôleur non trouvé (par exemple, afficher une erreur 404)
    require_once './app/templates/404.php';
}
