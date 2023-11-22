<?php

namespace Clipmaker\Controllers;
use Clipmaker\Models\UploadModel;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class UploadController
{
    public function index()
    {
        // Afficher la vue d'upload
        include './app/Views/UploadView.php';
    }

    public function handleUpload()
    {
        // Gérer l'upload de la vidéo lors de la soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = './depot/videos/';
                $videoTitle = $_POST['video_title'];
                $videoDescription = $_POST['video_description'];

                // Génération d'un nom unique pour la vidéo
                $uniqueName = uniqid('video_') . '_' . basename($_FILES['video']['name']);
                $uploadFile = $uploadDir . $uniqueName;
                $uploadModel = new UploadModel();

                try {
                    // Création de l'objet FFMpeg
                    $ffmpeg = FFMpeg::create();

                    // Chargement de la vidéo
                    $video = $ffmpeg->open($_FILES['video']['tmp_name']);

                    // Conversion de la vidéo en un format compatible (X264)
                    $format = new X264();
                    $format->setAudioCodec("aac");

                    // Définition du chemin de la vidéo après conversion
                    $convertedFile = $uploadDir . 'converted_' . $uniqueName;

                    // Encodage et sauvegarde de la vidéo convertie
                    $video->save($format, $convertedFile);

                    // Ajout de la vidéo convertie à la base de données
                    $generatedName = $uploadModel->addVideoToDatabase($videoTitle, $convertedFile, $videoDescription);

                    // Redirection vers la page de progression avec le nom généré
                    header("Location: /video/index/$generatedName");
                    exit;
                } catch (\Exception $e) {
                    echo 'Erreur lors du traitement de la vidéo : ' . $e->getMessage();
                }
            } else {
                echo 'Erreur : Veuillez sélectionner une vidéo.';
            }
        }
    }
}
