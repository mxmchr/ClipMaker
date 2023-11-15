<?php

class ClipsController {
    // Action pour afficher tous les clips
    public function index() {
        // Instanciez le modèle ClipsModel
        $clipsModel = new ClipsModel();

        // Récupérez tous les clips
        $clips = $clipsModel->getAllClips();

        // Chargez la vue ClipsView en passant les clips en paramètre
        require_once './app/views/ClipsView.php';
        $clipsView = new ClipsView();
        $clipsView->showAllClips($clips);
    }
}
