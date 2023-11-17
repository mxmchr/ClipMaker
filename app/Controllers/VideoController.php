<?php

namespace Clipmaker\Controllers;
use Clipmaker\Models\VideoModel;
use FFMpeg\FFMpeg;

require_once './app/Models/VideoModel.php';
class VideoController
{
    public function index($videoId)
    {
        $videoModel = new VideoModel();
        $videoPath = $videoModel->getVideoPathById($videoId);
        $videoTitle = $videoModel->getVideoTitleById($videoId);
        $videoDescription = $videoModel->getVideoDescriptionById($videoId);

        require_once './app/Views/VideoView.php';
    }
    public function clip(string $videoPath='/depot/videos/test.mp4')
    {
        $clipStart = $_POST['clipStart'];
        $clipStop = $_POST['clipStop'];
        $frameTime = $_POST['frameTime'];
        $clipTime = $clipStop - $clipStart;
        $ffmpeg = FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($videoPath);
        $duration = $ffmpeg->getFFProbe()
            ->format($videoPath)
            ->get('duration');

        // Vérifie si la variable $frameTime n'est pas vide
        if (!empty($frameTime)) {
            // Crée une image à partir d'une frame à la position $frameTime du fichier vidéo
            $video
                ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($frameTime))
                ->save('/depot/screenshots/frame.jpg');
            $frame = true;  // Indique que le screenshot (frame) a été réalisé
        } else {
            $frame = false;  // Indique que le screenshot (frame) n'a pas été réalisé
        }

        // Vérifie si la variable $clipStop n'est pas vide
        if (!empty($clipStop)) {
            // Crée un clip vidéo à partir d'une plage de temps définie par $clipStart et $clipTime
            $video
                ->clip(FFMpeg\Coordinate\TimeCode::fromSeconds($clipStart), FFMpeg\Coordinate\TimeCode::fromSeconds($clipTime))
                ->save(new FFMpeg\Format\Video\X264(), '/depot/clips/video.avi');
            $clip = true;  // Indique que le clip a été réalisé
        } else {
            $clip = false;  // Indique que le clip n'a pas été réalisé
        }

        if (!$frame && !$clip) {
            $msg = "Veuiller choisir une action en remplissant le champ fin du clip, ou capture";
        }
        //il faut rediriger vers la page /video/index/{id} pour continuer les modificaiton
        // si $clip || $frame == true ajouter lien dans la vue pour rediriger vers le clip ou la frame
    }
}

