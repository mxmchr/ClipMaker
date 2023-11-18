<?php

namespace Clipmaker\Controllers;

use Clipmaker\Models\ClipsModel;
use Clipmaker\Views\ClipsView;

class ClipsController {
    // Action pour afficher tous les clips
    public function index(): void
    {
        // Instanciez le modèle ClipsModel
        $clipsModel = new ClipsModel();

        // Récupérez tous les clips
        $clips = $clipsModel->getAllClips();

        // Chargez la vue ClipsView en passant les clips en paramètre
        require_once './app/Views/ClipsView.php';
        $clipsView = new ClipsView();
        $clipsView->showAllClips($clips);
    }

    public function search() {
        $val_search = $_GET['val'];

    }

    public function download() {
        // Chemin du fichier sur le serveur
        $chemin_fichier = ABSPATH . '/depot/clips/video.mp4';

        // Nom du fichier à télécharger
        $nom_fichier = 'clip.mp4';

        // Définit les en-têtes HTTP
        header('Content-Description: File Transfer');
        header('Content-Type: video/mp4');
        header('Content-Disposition: attachment; filename=' . $nom_fichier);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($chemin_fichier));

        // Lit le fichier et l'envoie au navigateur
        readfile($chemin_fichier);
        exit;
    }
}
