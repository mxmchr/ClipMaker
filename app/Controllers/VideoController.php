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

        if (!$video) {
            // Gérer l'erreur, par exemple :
            echo "La vidéo n'a pas été trouvée.";
            return;
        }

        $videoPath = ABSPATH . ltrim($video['file_path'], '/');

        require_once './app/Views/VideoView.php';
    }

    public function clip($videoId)
    {
        $videoModel = new VideoModel();
        $videoPath = $videoModel->getVideoPathById($videoId);

        if (!$videoPath) {
            echo "Le chemin de la vidéo n'a pas été trouvé.";
            return;
        }

        $videoPath = ABSPATH . ltrim($videoPath['file_path'], '/');
        $clipStart = (float)($_POST['clipStart'] ?? 0);
        $clipStop = (float)($_POST['clipStop'] ?? 0);
        $frameTime = (float)($_POST['frameTime'] ?? 0);
        $clipName = $_POST['clipName'] ?? '';
        $captureName = $_POST['captureName'] ?? '';
        $clipTime = $clipStop - $clipStart;

        // Créer une instance FFMpeg
        $ffmpeg = FFMpeg::create();

        // Ouvrir la vidéo avec FFMpeg
        $video = $ffmpeg->open($videoPath);

        try {
            // Vérifier si la variable $frameTime n'est pas vide
            if (!empty($frameTime) && $frameTime != 0) {
                // Créer une image à partir d'une frame à la position $frameTime du fichier vidéo
                $video->frame(TimeCode::fromSeconds($frameTime))->save(ABSPATH . 'depot/screenshots/' . $captureName . '.jpg');
                $frame = true;  // Indiquer que le screenshot (frame) a été réalisé
            } else {
                $frame = false;  // Indiquer que le screenshot (frame) n'a pas été réalisé
            }

            // Vérifier si la variable $clipStop n'est pas vide
            if (!empty($clipStop) && $clipStop != 0) {
                // Créer un clip vidéo à partir d'une plage de temps définie par $clipStart et $clipTime
                $video->clip(TimeCode::fromSeconds($clipStart), TimeCode::fromSeconds($clipTime))->save(new X264(), ABSPATH . 'depot/clips/' . $clipName . '.mp4');
                $clip = true;  // Indiquer que le clip a été réalisé
            } else {
                $clip = false;  // Indiquer que le clip n'a pas été réalisé
            }

            $msg = 'Test';  // Initialiser le message
            //définir le message à afficher lors du retour
            if (!$clipStop && $clipStart) {
                $msg = "Veuiller entrer une valeur pour la fin du clip";
            } elseif (!$frame && !$clip) {
                $msg = "Veuillez choisir une action en remplissant le champ fin du clip ou capture.";
            } elseif ($frame && !$clip) {
                $msg = "La capture a été réalisée avec succès.";
            } elseif (!$frame && $clip) {
                $msg = "Le clip a été réalisé avec succès.";
            } elseif ($frame && $clip) {
                $msg = "La capture et le clip ont été réalisés avec succès.";
            }

            if ($clip) {
                // Insérer les informations du clip dans la table "clips"
                $clipFilePath = '/depot/clips/' . $clipName . '.mp4';
                $clipTitle = $clipName ?: 'Titre par défaut'; // Utiliser le titre fourni ou un titre par défaut

                // Utiliser le modèle pour insérer les informations du clip
                $videoModel = new VideoModel();

                try {
                    $videoModel->insertClip((int)$videoId, $clipFilePath, $clipTitle);
                } catch (PDOException $e) {
                    // Gérer l'exception PDO ici
                    echo "Erreur PDO : " . $e->getMessage();
                }
            }

            // Rediriger vers la page /video/index/{id}
            $redirectUrl = "/video/index/$videoId?clipMessage=" . urlencode($msg);
            echo '<form id="intermediateForm" action="' . $redirectUrl . '" method="post">
              <input type="hidden" name="videoId" value="' . $videoId . '">
                  </form>';
            echo '<script>
              document.getElementById("intermediateForm").submit();
                  </script>';

        } catch (\Exception $e) {
            echo 'Erreur FFMpeg : ' . $e->getMessage();
        }
    }
}
