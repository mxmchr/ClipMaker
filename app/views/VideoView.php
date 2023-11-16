<main class="videoViews">
    <h1>Ma Video</h1>

    <video width="640" height="360" controls>
        <source src="<?php echo $videoPath; ?>" type="video/mp4">
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./public/js/video.js"></script>

</main>
