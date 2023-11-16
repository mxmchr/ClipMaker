<?php

class VideoModel
{
    public function getVideoPathById($videoId)
    {
        $db = new Database();
        $conn = $db->connect();

        $query = "SELECT file_path FROM videos WHERE id = :videoId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':videoId', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['file_path'];
    }
}

