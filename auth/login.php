<?php
require_once "./inc/_login.php";
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

    <title>Connexion</title>
</head>

<body>
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="../auth/register" class="cta" id="sign-up">S'enregistrer</a>
        </div>
    </header>
    <main class="main-container">
        <div class="prompt-container">
            <img class="identifier-img" src="../resources/img/connecter.svg" alt="connect illustration">
            <?php if ($error !== null) : ?>
                <p style="background: #FAA; color: red; padding: .5rem .75rem">
                    <?= $error ?>
                </p>
            <?php endif; ?>
            <form method="POST" class="register-content">
                <label for="login" class="label-tag">Identifiant
                <input type="text" class="input-tag" id="login" name="login"></label>
                <label for="password" class="label-tag">Mot de passe
                <input type="password" class="input-tag" id="password" name="password"></label>

                <input type="submit" value="Connexion" class="submit">
            </form>
        </div>
    </main>
</body>

</html>