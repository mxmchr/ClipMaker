<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clip Maker</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href='./css/style.css'>
</head>

<body class="container">
<nav class="navbar">
    <ul class="list">
        <li class="list__item">Logo</li>
        <li class="list__item"><a href="#" class="list__link">Liste des clips</a></li>
    </ul>
</nav>

<main>
    <article>

        <h1>Ma Video</h1>

        <video width="640" height="360" controls>
            <source src="./mp4/input.mp4" type="video/mp4">
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
</main>
</body>
</html>
