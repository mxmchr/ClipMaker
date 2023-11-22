<?php

namespace Clipmaker\Controllers;

use Clipmaker\Models\ClipsModel;
use Clipmaker\Views\ClipsView;

class ClipsController {
    public function index()
    {
        $clipsModel = new ClipsModel();
        $clips = $clipsModel->getAllClips();

        $clipsView = new ClipsView();
        $clipsView->showAllClips($clips);
    }

    public function download()
    {
        $chemin_fichier = ABSPATH . '/depot/clips/video.mp4';
        $nom_fichier = 'clip.mp4';

        header('Content-Description: File Transfer');
        header('Content-Type: video/mp4');
        header('Content-Disposition: attachment; filename=' . $nom_fichier);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($chemin_fichier));

        readfile($chemin_fichier);
        exit;
    }
}
