<?php

namespace Clipmaker\Controllers;

use Clipmaker\Models\ClipsModel;
use Clipmaker\Views\ClipsView;

class ClipsController {
    // Action pour afficher tous les clips
    public function index() {
        // Instanciez le modèle ClipsModel
        $clipsModel = new ClipsModel();

        // Récupérez tous les clips
        $clips = $clipsModel->getAllClips();

        // Chargez la vue ClipsView en passant les clips en paramètre
        require_once './app/Views/ClipsView.php';
        $clipsView = new ClipsView();
        $clipsView->showAllClips($clips);
    }

    public function download() {
        /*// Envoi des en-têtes pour forcer le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $downloadFileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($videoPath));

        // Lecture du fichier et envoi du contenu
        readfile($videoPath);
        exit;*/
        echo "download page";
    }
}
