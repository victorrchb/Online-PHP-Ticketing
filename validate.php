<?php
require_once "./inc/_validate.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./resources/styles.css">
    
    <title>Validation du billet</title>
</head>
<body>
    <header>
        <a href="./index.php"><img src="./resources/img/logo.svg" alt="logo" id="logo"></a>
    </header>

    <main>
        <?php if ($ticketExists === true) : ?>
            <h1 style="background: #AFA; color: green; padding: .5rem .75rem">
                Validé
            </h1>
        <?php else : ?>
            <div class="prompt-container">
                <h1>Validez votre billet</h1>
                <?php if ($error !== null) : ?>
                    <p style="background: #FAA; color: red; padding: .5rem .75rem">
                        <?= $error ?>
                    </p>
                <?php endif; ?>
                <form method="post" class="register-content">
                    <label for="firstname" class="label-tag">Prénom :</label>
                    <input type="text" id="firstname" name="firstname" class="input-tag" required>

                    <label for="lastname" class="label-tag">Nom :</label>
                    <input type="text" id="lastname" name="lastname" class="input-tag" required>
                    
                    <label for="code" class="label-tag">Identifiant du billet :</label>
                    <input type="text" id="code" name="code" class="input-tag" class="input-tag" required>

                    <input type="submit" value="Envoyer" class="submit">
                </form>
            </div>
        <?php endif ?>
    </main>
</body>
</html>