<?php

require_once './app/models/UploadModel.php';

class UploadController
{
    public function index()
    {
        include './app/views/UploadView.php';
    }

    public function handleUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = './depot/videos/';
                $videoTitle = $_POST['video_title'];
                $videoDescription = $_POST['video_description'];

                // Génération d'un nom unique pour la vidéo
                $uniqueName = uniqid('video_') . '_' . basename($_FILES['video']['name']);
                $uploadFile = $uploadDir . $uniqueName;
                $uploadModel = new UploadModel();

                if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
                    $generatedName = $uploadModel->addVideoToDatabase($videoTitle, $uploadFile, $videoDescription);

                    header("Location: /video/$generatedName");
                    exit;
                } else {
                    echo 'Erreur lors de l\'upload du fichier.';
                }
            } else {
                echo 'Erreur : Veuillez sélectionner une vidéo.';
            }
        }
    }
}
