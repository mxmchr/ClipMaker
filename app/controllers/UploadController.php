<?php

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
                $uploadDir = 'chemin/vers/votre/dossier/upload/';
                $uploadFile = $uploadDir . basename($_FILES['video']['name']);

                if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
                    // Le fichier a été téléchargé avec succès
                    // Vous pouvez maintenant ajouter les informations de la vidéo à votre base de données
                    $videoTitle = $_FILES['video']['name']; // Changez cela en fonction de votre structure de base de données
                    $videoFilePath = $uploadFile; // Changez cela en fonction de votre structure de base de données

                    // Ajoutez ces informations à votre base de données (utilisez votre propre logique ici)

                    // Redirigez l'utilisateur vers une page de confirmation ou autre
                    header('Location: /clips');
                    exit;
                } else {
                    // Une erreur s'est produite lors du téléchargement du fichier
                    echo 'Erreur lors de l\'upload du fichier.';
                }
            } else {
                // Aucun fichier téléchargé ou une erreur s'est produite
                echo 'Erreur : Veuillez sélectionner une vidéo.';
            }
        }
    }
}