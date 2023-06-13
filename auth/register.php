<?php
require_once "./inc/_register.php"
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

    <title>Inscription</title>
</head>

<body class="register-body">
    <header>
        <a href="../index.php"><img src="../resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="../auth/login" class="cta" id="sign-in">Connexion</a>
        </div>
    </header>

    <main class="main-container">
        <div class="prompt-container">
            <img alt="s'identifier" src="../resources/img/identifier.svg" class="identifier-img">
            <?php if ($error !== null) : ?>
                <p style="background: #FAA; color: red; padding: .5rem .75rem">
                    <?= $error ?>
                </p>
            <?php endif; ?>
            <form method="POST" class="register-content">
                <label for="login" class="label-tag">Nom d'utilisateur
                <input type="text" class="input-tag" id="login" name="login" required></label>
                <label for="password" class="label-tag">Mot de passe
                <input type="password" class="input-tag" id="password" name="password" required></label>
                <label for="cpassword" class="label-tag">Confirmer le mot de passe
                <input type="password" class="input-tag" id="cpassword" name="cpassword" required></label>
                <input type="submit" value="Valider" class="submit">
            </form>
        </div>
    </main>
</body>

</html>