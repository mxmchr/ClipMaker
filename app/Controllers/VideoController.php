<?php

namespace Clipmaker\Controllers;
use Clipmaker\Models\VideoModel;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use PDOException;

class VideoController
{
    public function index($videoId)
    {
        $videoModel = new VideoModel();
        $video = $videoModel->getVideo($videoId);
        $videoPath = ABSPATH . ltrim($video['file_path'], '/');


        require_once './app/Views/VideoView.php';
    }
    public function clip($videoId)
    {
        //TO DO : récupérer $videoPath
        $videoPath = ABSPATH . "depot/videos/test.mp4";
        $clipStart = $_POST['clipStart'];
        $clipStop = $_POST['clipStop'];
        $frameTime = $_POST['frameTime'];
        $clipTime = $clipStop - $clipStart;
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($videoPath);
        $duration = $ffmpeg->getFFProbe()
            ->format($videoPath)
            ->get('duration');

        // Vérifie si la variable $frameTime n'est pas vide
        if (!empty($frameTime) && ($frameTime != 0)) {
            // Crée une image à partir d'une frame à la position $frameTime du fichier vidéo
            $video
                ->frame(TimeCode::fromSeconds($frameTime))
                ->save(ABSPATH . 'depot/screenshots/frame.jpg');

            $frame = true;  // Indique que le screenshot (frame) a été réalisé
        } else {
            $frame = false;  // Indique que le screenshot (frame) n'a pas été réalisé
        }

        // Vérifie si la variable $clipStop n'est pas vide
        if (!empty($clipStop) && $clipStop != 0) {
            // Crée un clip vidéo à partir d'une plage de temps définie par $clipStart et $clipTime
            $video
                ->clip(TimeCode::fromSeconds($clipStart), TimeCode::fromSeconds($clipTime))
                ->save(new X264(), ABSPATH . 'depot/clips/video.mp4');
            $clip = true;  // Indique que le clip a été réalisé
        } else {
            $clip = false;  // Indique que le clip n'a pas été réalisé
        }

        if (!$frame && !$clip) {
            $msg = "Veuiller choisir une action en remplissant le champ fin du clip, ou capture";
        }

        if ($clip) {
            // Insérer les informations du clip dans la table "clips"
            $clipFilePath = '/depot/clips/video.mp4'; // Chemin du clip vidéo
            $clipTitle = 'Nom du clip'; // Remplacez par le titre approprié

            // Utilisation du modèle pour insérer les informations du clip
            $videoModel = new VideoModel();

            try {
                $videoModel->insertClip((int)$videoId, $clipFilePath, $clipTitle);
            } catch (PDOException $e) {
                // Gérer l'exception PDO ici
                echo "Erreur PDO : " . $e->getMessage();
                // Vous pouvez également enregistrer l'erreur dans un fichier de journal ou effectuer d'autres actions nécessaires.
            }
        }

        // Redirection vers la page /video/index/{id}
        // si $clip || $frame == true ajouter lien dans la vue pour rediriger vers le clip ou la frame ()
        header("Location: /video/index/$videoId");
    }
}

