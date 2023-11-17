<?php
namespace Clipmaker\Models;

use Clipmaker\Config;
use PDO;
class VideoModel
{
    public function getVideoPathById($videoId)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT file_path FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['file_path'];
    }

    public function getVideoTitleById($videoId)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT Title FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['Title'];
    }
    public function getVideoDescriptionById($videoId)
    {
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT Description FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['Description'];
    }
}

