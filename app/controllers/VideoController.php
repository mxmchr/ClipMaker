<?php

class VideoController
{
    public function index($videoId)
    {
        $videoModel = new VideoModel();
        $videoPath = $videoModel->getVideoPathById($videoId);

        require_once './app/views/VideoView.php';
    }
}

