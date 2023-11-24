<?php

namespace Clipmaker\Controllers;

use Clipmaker\Models\ClipsModel;
use Clipmaker\Views\ClipsView;

class ClipsController {
    /**
     * Affiche tous les clips.
     */
    public function index()
    {
        // Instancie le modèle des clips
        $clipsModel = new ClipsModel();

        // Récupère tous les clips depuis le modèle
        $clips = $clipsModel->getAllClips();

        // Instancie la vue des clips
        $clipsView = new ClipsView();

        // Affiche tous les clips à l'aide de la vue
        $clipsView->showAllClips($clips);
    }

    /**
     * Télécharge le clip au format MP4.
     */
    public function download()
    {
        // Chemin du fichier à télécharger
        $chemin_fichier = ABSPATH . '/depot/clips/video.mp4';

        // Nom du fichier téléchargé
        $nom_fichier = 'clip.mp4';

        // En-têtes pour le téléchargement du fichier
        header('Content-Description: File Transfer');
        header('Content-Type: video/mp4');
        header('Content-Disposition: attachment; filename=' . $nom_fichier);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($chemin_fichier));

        // Lit et transmet le fichier au client
        readfile($chemin_fichier);

        // Termine l'exécution du script
        exit;
    }
}
