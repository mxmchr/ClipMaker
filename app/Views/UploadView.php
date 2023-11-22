<article class="form__container">
    <h1 class="title__View">Upload video</h1>
    <p class="p__upload">
        Veillez uploader votre vidéo pour l'éditer par la suite
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

        <!-- Ajout des autres champs ici -->

        <div class="form__group">
            <label for="video">Sélectionnez une vidéo :</label>
            <input type="file" name="video" accept="video/*" required>
        </div>

        <button type="submit">Uploader</button>
    </form>

    <!-- Affichage de l'avancement de l'upload -->
    <div id="upload-progress" style="display:none;">
        <p id="progress-text">Progression : <span id="progress-percentage">0%</span></p>
        <progress id="progress-bar" value="0" max="100"></progress>
    </div>

    <script>
        // Fonction pour masquer le formulaire et afficher la progression
        function showProgress() {
            document.querySelector('.form__upload').style.display = 'none';
            document.getElementById('upload-progress').style.display = 'block';
        }

        // Fonction pour mettre à jour l'avancement de l'upload
        function updateProgress(percentage) {
            document.getElementById('progress-percentage').innerText = percentage + '%';
            document.getElementById('progress-bar').value = percentage;
        }

        // Soumission du formulaire
        document.querySelector('.form__upload').addEventListener('submit', function () {
            // Afficher la progression lorsque le formulaire est soumis
            showProgress();
        });

        // EventSource pour la communication SSE
        const eventSource = new EventSource("/uploadProgress");

        // Écouteur d'événement pour les mises à jour de l'avancement
        eventSource.addEventListener("progress", function (event) {
            const data = JSON.parse(event.data);
            updateProgress(data.percentage);
        });

        // Fermer la connexion SSE lorsque la page est fermée ou actualisée
        window.addEventListener("beforeunload", function () {
            eventSource.close();
        });
    </script>
</article>
