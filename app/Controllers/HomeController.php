<?php

namespace Clipmaker\Controllers;
require_once './app/Models/HomeModel.php';
class HomeController
{
    /**
     * Affiche la page d'accueil.
     */
    public function index(): void
    {
        // Charge la vue HomeView
        require_once './app/Views/HomeView.php';
    }
}
