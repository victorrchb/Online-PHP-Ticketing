<?php
require_once "./inc/_event_list.php"
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

    <title>Votre espace</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="../auth/_logout" class="cta" id="disconnect">Déconnexion</a>
        </div>
    </header>
    <main class="dashboard-main">
        <div class="title-container">
            <h1 class="h1">Vous êtes connecté(e) !</h1>
        </div>
        <a href="./create_event" id="cta-a">
            <img class="event-create-cta" alt="Create event" src="../resources/img/add-icon.svg">
        </a>
        <div class="grid-container">
            
            <?php if ($events !== null) : ?>
                <?php foreach($events as $event) : ?>
                    <?php 
                        if ($event["image"] == null) {
                            $event["image"] = "../resources/img/placeholder.jpg";
                        }
                        $date = substr($event["date"], 0, 10);
                        $time = substr($event["date"], 11, 5);
                    ?>
                    <div class="event-card">
                        <a class="detail-card" href="./event_details?id=<?= $event["id"] ?>">
                            <img src="<?= $event["image"]; ?>" class="event-img">
                            <h2 class="event-name-dashboard">
                                <?= $event["name"] ?>
                            </h2>
                            <p>
                                <?= $date ?>
                            </p>
                            <p>
                                <?= $time ?>
                            </p>
                            <p class="description">
                                <?= $event["description"] ?>
                            </p>
                        </a>
                        <?php if ($event["active"] == 1) : ?>
                            <div class="modifier-annuler">
                                <a class="cta event-modify" href="./modify_event?id=<?= $event["id"] ?>">Modifier</a>
                                <a class="cta event-modify" href="./_cancel_event?id=<?= $event["id"] ?>">Annuler</a>
                            </div>
                        <?php elseif ($event["active"] == 0) : ?>
                            <p id="p-cancel"><em id="cancel">annulé</em></p>
                        <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>