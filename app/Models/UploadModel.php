<?php

namespace Clipmaker\Models;

use Clipmaker\Config;
use PDOException;

class UploadModel
{
    private $db;

    /**
     * Constructeur pour initialiser la connexion à la base de données.
     */
    public function __construct()
    {
        $this->db = (new Config())->connect();
    }

    /**
     * Ajoute les informations de la vidéo à la base de données.
     *
     * @param string $videoTitle Le titre de la vidéo.
     * @param string $videoFilePath Le chemin du fichier vidéo.
     * @param string $videoDescription La description de la vidéo.
     * @return int|false L'ID généré pour la vidéo ajoutée ou false en cas d'erreur.
     */
    public function addVideoToDatabase($videoTitle, $videoFilePath, $videoDescription)
    {
        try {
            // Préparez la requête SQL
            $stmt = $this->db->prepare("INSERT INTO videos (title, file_path, description) VALUES (:title, :file_path, :description)");

            // Liez les paramètres
            $stmt->bindParam(':title', $videoTitle);
            $stmt->bindParam(':file_path', ltrim($videoFilePath, '.')); // Ajout de ltrim pour retirer le point initial du chemin
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
