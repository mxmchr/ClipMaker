<?php

namespace Clipmaker\Models;

use Clipmaker\Config;
use PDO;

class VideoModel
{
    /**
     * Récupère les informations de la vidéo avec l'ID spécifié.
     *
     * @param int $videoId L'ID de la vidéo.
     * @return array|false Tableau associatif représentant les informations de la vidéo ou false si non trouvée.
     */
    public function getVideo($videoId)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT * FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le chemin du fichier vidéo avec l'ID spécifié.
     *
     * @param int $videoId L'ID de la vidéo.
     * @return array|false Tableau associatif représentant le chemin du fichier vidéo ou false si non trouvé.
     */
    public function getVideoPathById($videoId)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT file_path FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insère les informations du clip dans la table "clips".
     *
     * @param int $videoId L'ID de la vidéo.
     * @param string $file_path Le chemin du fichier clip.
     * @param string $title Le titre du clip.
     */
    public function insertClip($videoId, $file_path, $title)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "INSERT INTO clips (video_id, file_path, title) VALUES (:video_id, :file_path, :title)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':video_id', $videoId, PDO::PARAM_INT);
        $stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);

        // Exécute la requête d'insertion
        $stmt->execute();
    }
}
