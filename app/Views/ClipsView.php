<?php

namespace Clipmaker\Views;

use Clipmaker\Models\ClipsModel;
class ClipsView
{
    // Méthode pour afficher tous les clips
    public function showAllClips($clips)
    {
        echo "<article class='article__clipsViews'>";

            echo "<h1 class='title__View'>Liste des clips</h1>";
            echo "<div class='search-container'>
                    <input type='text' class='search-input' id='idbarrederecher' placeholder='Rechercher...'>
                    <button class='search-button'>Rechercher</button>
                </div>";

            echo "<ul class='list__clips'>";
                foreach ($clips as $clip) {
                    $clipsModel = new ClipsModel();
                    $formattedDate = $clipsModel->formatCreatedAt($clip->created_at);

                    echo '<li class="list__itemClips">';
                        echo'<header class="clip__header">';
                            echo '<h2 class="title__clips"><a href="">' . $clip->title . '</a></h2>';
                            echo '<button class="view-button" onclick="window.location.href=\'/video/index/' . $clip->video_id . '\'" title="Voir la vidéo original"></button>';
                        echo'</header>';
                        echo '<video width="400" height="225" controls class="clipView__clip">';
                            echo '<source src="' . $clip->file_path . '" type="video/mp4">';
                        echo '</video>';
                        echo '<div class="list__footer">';
                            echo '<h3 class="title__date">' . $formattedDate . '</h3>';
                            echo '<form action="/clips/download" method="post">';
                                echo '<button class="download-button" type="submit" name="download">Télécharger</button>';
                            echo '</form>';
                        echo '</div>';
                    echo '</li>';

                }
            echo "</ul>";
        echo "</article>";
    }
}
