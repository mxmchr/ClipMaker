<?php

class VideoController
{
    public function index($videoId)
    {
        $videoModel = new VideoModel();
        $videoPath = $videoModel->getVideoPathById($videoId);
        $videoTitle = $videoModel->getVideoTitleById($videoId);

        require_once './app/views/VideoView.php';
    }

    public function clip(string $videoPath, float $clipStart=0, float $clipStop=0, int $frameTime=0)
    {
        $clipTime = $clipStop - $clipStart;
        $ffmpeg = FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($videoPath);
        $video
            ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($frameTime))
            ->save('./frame.jpg');
        $clip = $video->clip(FFMpeg\Coordinate\TimeCode::fromSeconds($clipStart), FFMpeg\Coordinate\TimeCode::fromSeconds($clipTime));
        $clip
            ->save(new FFMpeg\Format\Video\X264(), './video.avi');
    }
}

