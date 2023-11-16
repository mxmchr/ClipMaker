<main class="videoViews">
    <h1 class="title__View"><?php echo $videoTitle;?></h1>
    <article class="videoView__article">
        <video class="videoView__video" width="640" height="360" controls>
            <source src="<?php echo $videoPath; ?>" type="video/mp4">
        </video>

        <form action="./clips" method="post" class="form__clip">
            <div class="">
                <label class="label__clip" for="begin">Début du clip</label>
                <input class="input__clip" placeholder="00.0 s" type="number" min="0" step="0.1"/>
            </div>
            <div class="">
                <label for="end">Fin du clip</label>
                <input class="input__clip" placeholder="00.0 s" type="number" min="0" step="0.1"/>
            </div>
            <div class="">
                <label class="label__clip" for="screenshot">Capture</label>
                <input class="input__clip" placeholder="00.0 s" type="number" min="0" step="0.1"/>
            </div>
            <div class="">
                <input type="submit" value="Clip" />
            </div>
        </form>
    </article>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./public/js/video.js"></script>

</main>
