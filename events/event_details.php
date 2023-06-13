<?php
require_once "./inc/_event_details.php"
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

    <title>Details</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="../auth/_logout" class="cta" id="disconnect">Déconnexion</a>
        </div>
    </header>
    <main>
        <div class="center-container">
            
            <h1><?= $event["name"] ?></h1>
            <div class="detail-card">
                <img src="<?= $event["image"] ?>" class="">
                <div><?= $date ?></div>
                <div><?= $time ?></div>
                <p><?= $event["description"] ?></p>
                <?php if ($event["active"] == 1) : ?>
                    <div class="modifier-annuler">
                        <a class="cta event-modify" href="./modify_event?id=<?= $event["id"] ?>">Modifier</a>
                        <a class="cta event-modify" href="./_cancel_event?id=<?= $event["id"] ?>">Annuler</a>
                    </div>
                <?php elseif ($event["active"] == 0) : ?>
                    <p><em id="cancel">évènement annulé</em></p>
                <?php endif; ?>
            </div>
        
        <div class="center-container user-container">
            
            <h2 id="participants">Participants:</h2>
            <?php if ($event["active"] == 1) : ?>
                <a id="cta-a" href="../tickets/create?id=<?= $id ?>">
                <img class="ticket-create-cta" alt="plus logo" src="../resources/img/add-icon.svg">
                </a>
            <?php endif; ?>
            <?php if ($tickets !== null) : ?>
                <table class="user-table">
                    <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Mail</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tickets as $ticket) : ?>
                            <tr>
                                <td><?= $ticket["id"] ?></td>
                                <td><?= $ticket["user_firstname"] ?></td>
                                <td><?= $ticket["user_lastname"] ?></td>
                                <td><?= $ticket["user_mail"] ?></td>
                                <td>
                                    <?php if ($event["active"] == 1) : ?>
                                        <a href="../tickets/_delete?id=<?= $id ?>&ticket_id=<?= $ticket["id"] ?>"><img src="../resources/img/delete-icon.svg" height="20px"></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        </div>
    </main>
</body>
</html>