<article class="form__container">

    <h1 class="title__View">Upload video</h1>
    <p class="p__upload">
        Veillez uploader votre video pour l'editer par la suite
    </p>

    <form action="/upload/handleUpload" method="post" enctype="multipart/form-data" class="form__upload">
        <div class="form__group">
            <label for="video_title">Titre de la vidéo :</label>
            <input type="text" name="video_title" required>
        </div>

        <div class="form__group">
            <label for="video_description">Description de la vidéo :</label>
            <textarea name="video_description"></textarea>
        </div>

        <div class="form__group">
            <label for="video">Sélectionnez une vidéo :</label>
            <input type="file" name="video" accept="video/*" required>
        </div>

        <button type="submit">Uploader</button>
    </form>
</article>

