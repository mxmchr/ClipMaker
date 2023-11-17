<?php

namespace Clipmaker\Controllers;
require_once './app/Models/HomeModel.php';
class HomeController
{
    public function index()
    {
        // Charger la vue HomeView
        require_once './app/Views/HomeView.php';
    }
}
