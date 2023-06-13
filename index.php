<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./resources/styles.css">
    <!-- font import -->
    <link rel="stylesheet" href="https://use.typekit.net/ytx2kvl.css">

    <title>Accueil</title>
</head>
<body class="homepage-container">
    <header>
        <a href="./index.php"><img src="./resources/img/logo.svg" alt="logo" id="logo"></a>

        <div class="nav-button">
            <a href="./auth/login" class="cta" id="sign-in">Connexion</a>
            <a href="./auth/register" class="cta" id="sign-up">S'enregistrer</a>
            <a href="./auth/_logout" class="cta" id="disconnect">Déconnexion</a>
            <a href="./tickets/details" class="cta" id="show-ticket">Afficher un billet</a>
            <a href="./validate" class="cta" id="validate-ticket">Valider un billet</a>
        </div>
    </header>

    <main class="homepage-main">
        <div class="homepage-content">
            <h1>Prends ton tikett</h1>
            <p>Gérez vos billets de concert en toute simplicité avec notre application intuitive et sécurisée.</p>
            <a class="cta" id="discover-event" href="./tickets/details">Affichez votre billet</a>
        </div>

        <img src="./resources/img/homepage.svg" alt="homepage illustration" id="homepage-illustration">
    </main>
</body>
</html>