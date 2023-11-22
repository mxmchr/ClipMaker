<main class="videoViews">
    <h1 class="title__View"><?php echo $video['title'];?></h1>
    <article class="videoView__article">
        <div class="video__container">
            <video class="videoView__video" width="640" height="360" controls>
                <source src="<?php echo $video['file_path']; ?>" type="video/mp4">
            </video>
            <p class="video__description">
                <?php echo $video['description'];?>
            </p>
        </div>
        <div class="div__formSubmit">
            <form action='/Video/clip/<?php echo $video['id']?>' method="post" class="form__clip">
                <div class="form__number">
                    <div class="form__divNumber">
                        <label class="label__clip" for="begin">Début du clip</label>
                        <input class="input__clip" name="clipStart" type="number" min="0" max="130" step="0.1" value="<?php echo isset($_POST['clipStart']) ? $_POST['clipStart'] : '0'; ?>"/>
                    </div>
                    <div class="form__divNumber">
                        <label for="end">Fin du clip</label>
                        <input class="input__clip" name="clipStop" type="number" min="0" max="100" step="0.1" value="<?php echo isset($_POST['clipStop']) ? $_POST['clipStop'] : '0'; ?>"/>
                    </div>
                    <div class="form__divNumber">
                        <label class="label__clip" for="screenshot">Capture</label>
                        <input class="input__clip" name="frameTime" type="number" min="0" step="0.1" value="<?php echo isset($_POST['frameTime']) ? $_POST['frameTime'] : '0'; ?>"/>
                    </div>
                </div>
                <div class="form__text">
                    <div class="form__divText">
                        <label class="label__clip" for="clipName">Nom du clip</label>
                        <input class="input__clip" name="clipName" type="text" placeholder="Nom du clip" value="<?php echo isset($_POST['clipName']) ? $_POST['clipName'] : ''; ?>"/>
                    </div>
                    <div class="form__divText">
                        <label class="label__clip" for="captureName">Nom de la capture</label>
                        <input class="input__clip" name="captureName" type="text" placeholder="Nom de la capture" value="<?php echo isset($_POST['captureName']) ? $_POST['captureName'] : ''; ?>"/>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Clip" />
                </div>
            </form>
            <?php if (!empty($_GET['clipMessage'])) : ?>
                <p class="Clip__message">
                    <?php
                    $list = array(
                        "Veuiller entrer une valeur pour la fin du clip",
                        "Veuillez choisir une action en remplissant le champ fin du clip ou capture.",
                        "La capture a été réalisée avec succès.",
                        "Le clip a été réalisé avec succès.",
                        "La capture et le clip ont été réalisés avec succès."
                    );
                    if (in_array($_GET['clipMessage'], $list)) {
                        echo htmlspecialchars($_GET['clipMessage']);;
                    }
                    ?>
                </p>
            <?php endif; ?>
        </div>

    </article>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</main>
