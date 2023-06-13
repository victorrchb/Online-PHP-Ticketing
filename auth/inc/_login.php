<?php

session_start();

require_once "./inc/_functions.php";

verifyLoggin();

$error = null;

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $login = filter_input(INPUT_POST, "login") ?? null;
    $password = filter_input(INPUT_POST, "password") ?? null;

    // Donnees a envoye pour la requete à l'API
    $data = [
        "login" => $login,
        "password" => $password
    ];
    $json = json_encode($data);

    // Location de l'API
    $destination = activePath() . "../../api/login";
    
    // Reponse de l'API
    [$response, $httpCode] = responseToRequest($destination, $json, "POST");

    // Si la requete passe
    if ($response["status"] === "success")
    {
        $_SESSION["token"] = $response["message"];
        header("Location: ../events/dashboard");
        exit();
    }
    else
    {
        // Cas d'erreur
        http_response_code($httpCode);
        $error = $response["message"];
    }
}