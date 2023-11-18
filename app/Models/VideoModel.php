<?php
namespace Clipmaker\Models;

use Clipmaker\Config;
use PDO;
class VideoModel
{
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

