<form action="/upload/handleUpload" method="post" enctype="multipart/form-data" class="form__upload">
    <label for="video">Titre de la vidéo :</label>
    <input type="text" name="video_title" required>
    <br>
    <label for="video_description">Description de la vidéo :</label>
    <textarea name="video_description"></textarea>
    <br>
    <label for="video">Sélectionnez une vidéo :</label>
    <input type="file" name="video" accept="video/*" required>
    <button type="submit">Uploader</button>
</form>
