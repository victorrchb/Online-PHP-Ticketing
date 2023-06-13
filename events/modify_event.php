<?php
require_once "./inc/_event_modify.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../resources/styles.css">
    <!-- font import -->
    <link rel="stylesheet" href="https://use.typekit.net/ytx2kvl.css">

    <title>Modifier un évènement</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="../auth/_logout" class="cta" id="disconnect">Déconnexion</a>
        </div>
    </header>
    <main class="center-container create-event-container create-modify-event">
        <h1>Modifier un évènement</h1>
        <form method="POST" class="register-content" id="event-form">
            <label for="name" class="label-tag">Nom de l'évènement*</label>
            <input class="input-tag" type="text" id="name" name="name" value="<?= $event["name"] ?>" placeholder="Nom de l'évènement" required>
            <label for="description" class="label-tag">Description de l'évènement</label>
            <textarea class="input-tag" type="text" id="description" name="description" placeholder="Description de mon évènement"><?= $event["description"] ?></textarea>
            <label for="image" class="label-tag">Image</label>
            <input class="input-tag" type="text" id="image" name="image" value="<?= $event["image"] ?>" placeholder="https://imagebank/image.png">
            <label for="date" class="label-tag">Date*</label>
            <input class="input-tag" type="date" id="date" value="<?= $date ?>" name="date" required>
            <label for="time" class="label-tag">Heure de début*</label>
            <input class="input-tag" type="time" id="time" name="time" value="<?= $time ?>" min="06:00" max="23:59" required>
            <input class="submit" type="submit" value="Ajouter l'évènement">
        </form>
    </main>
</body>
</html>