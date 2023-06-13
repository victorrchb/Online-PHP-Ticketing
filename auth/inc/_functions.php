<?php

function activePath()
{
    $path = "http" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $path;
}

function responseToRequest($destination, $json, $method)
{
    if ($method=="POST") {
        $ch = curl_init($destination);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
        );
    } elseif ($method=="GET") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $destination . "?json=" . urlencode($json));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    

    // exécuter la requête et récupérer la réponse
    $result = curl_exec($ch);

    // Obtenir le code de statut HTTP
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // fermer la session cURL
    curl_close($ch);
    $response = json_decode($result, true);
    
    return [$response, $httpCode];
}

function verifyRequest()
{
    $data = [
        "token" => $_SESSION["token"]
    ];
    $json = json_encode($data);

    // Location de l'API
    $parsed = parse_url(activePath());
    $url = $parsed['scheme'] . '://' . $parsed['host'] . $parsed['path'];
    $destination = $url . "../../../auth/api/verify";
    
    // Reponse de l'API
    [$response, $httpCode] = responseToRequest($destination, $json, "POST");
    // On vérifie si la requête est un echec
    if ($response["status"] === "error") {
        // Si la requete passe, l'ajout a la bdd a ete fait donc on redirige
        session_destroy();
        header("Location: ../auth/login");
        exit();
    }
    // Sinon c'est autorise donc on fait rien
}

function verifyLoggin()
{
    // si la personne a un token
    if(isset($_SESSION["token"]))
    {
        if (substr(activePath(), -strlen("/auth/login")) !== "/auth/login")
        {
            // Check si le jeton est toujours d'actualite
            verifyRequest();
        } // On regarde seulement quand on pas sur la page login car verifyRequest() renvoie vers le login s'il n'y a plus de token, cela evite les requetes infinies
        header('Location: ../events/dashboard.php');
        exit();
    }
}

function verifyToken()
{
    // si la personne n'a plus son jeton connectée
    if(!isset($_SESSION["token"]))
    {
        header('Location: ../auth/login.php');
        exit();
    }
}