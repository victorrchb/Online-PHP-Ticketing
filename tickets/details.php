<?php
require_once "./inc/_details.php"
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

    <title>Vos billets</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>
    </header>

    <main>
        <?php if ($page == "form") : ?>
            <div class="prompt-container">
                <h1>Afficher votre billet</h1>
                <?php if ($error !== null) : ?>
                    <p style="color: red; padding: .5rem .75rem">
                        <?= $error ?>
                    </p>
                <?php endif; ?>
                <form method="POST" class="register-content">
                    <label for="firstname" class="label-tag">Prénom
                    <input type="text" class="input-tag" id="firstname" name="firstname" required></label>
                    <label for="lastname" class="label-tag">Nom
                    <input type="text" class="input-tag" id="lastname" name="lastname" required></label>
                    <label for="id" class="label-tag">Identifiant privé
                    <input type="text" class="input-tag" id="id" name="id" required></label>

                    <input type="submit" value="Afficher" class="submit">
                </form>
            </div>
        <?php elseif ($page == "ticket") : ?>
        <div class="prompt-container">
            <span id="ticket-hash">Billet: <?= $ticket["id"] ?></span>
            <img src="./_qrcode?content=<?= urlencode($qrCodeURL) ?>" id="qr-code-img" alt="QR Code">
            <table class="details-table">
                <tr>
                    <th>Nom du visiteur</th>
                    <td><?= $ticket["user_firstname"] . " " . $ticket["user_lastname"] ?></td>
                </tr>
                <tr>
                    <th>Mail</th>
                    <td><?= $ticket["user_mail"] ?></td>
                </tr>
                <tr>
                    <th>Évènement</th>
                    <td><?= $event["name"] ?></td>
                </tr>
                <tr>
                    <th>Date de l'évènement</th>
                    <td><?= $event["date"] ?></td>
                </tr>
                <tr>
                    <th>Création du billet</th>
                    <td><?= $ticket["created_at"] ?></td>
                </tr>
            </table>
        </div>
        <?php endif ?>
    </main>
</body>
</html>