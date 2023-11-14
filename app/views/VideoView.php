<?php include './app/templates/header.php'; ?>

<article>

    <h1>Ma Video</h1>

    <video width="640" height="360" controls>
        <source src="./public/mp4/input.mp4" type="video/mp4">
    </video>

    <form action="" method="get" class="form_video">
        <div class="">
            <label for="begin">Début du clip</label>
            <input type="text" required />
        </div>
        <div class="">
            <label for="end">Fin du clip</label>
            <input type="text" required />
        </div>
        <div class="">
            <input type="submit" value="Clip" />
        </div>
    </form>

</article>
