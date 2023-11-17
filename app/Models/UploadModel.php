<?php

namespace Clipmaker\Models;
class UploadModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function addVideoToDatabase($videoTitle, $videoFilePath, $videoDescription)
    {
        try {
            // Préparez la requête SQL
            $stmt = $this->db->prepare("INSERT INTO videos (title, file_path, description) VALUES (:title, :file_path, :description)");
            $test = ltrim($videoFilePath,'.');
            // Liez les paramètres
            $stmt->bindParam(':title', $videoTitle);
            $stmt->bindParam(':file_path', $test);
            $stmt->bindParam(':description', $videoDescription);

            // Exécutez la requête
            $stmt->execute();

            // Récupérez l'ID généré pour la vidéo nouvellement ajoutée
            $lastInsertId = $this->db->lastInsertId();

            // Retournez l'ID généré
            return $lastInsertId;
        } catch (PDOException $e) {
            // Gérez les erreurs d'insertion dans la base de données
            echo "Erreur d'insertion dans la base de données : " . $e->getMessage();
            return false;
        }
    }
}


