<!-- Page 404 -->

<p class="p__codeErreur">
    404. Erreur
</p>
<p class="p__messageErreur">
    La requête URL
    <span class="span__urlErreur">
        <?php
        // Récupération des segments de l'URL pour l'afficher à l'utilisateur
        $response = "/" . $segments[0];
        if (!empty($segments[1])) {
            $response = $response . "/" . $segments[1];
        }
        echo $response;
        ?>
    </span>
    n'a pas été trouvée sur ce serveur.
</p>
