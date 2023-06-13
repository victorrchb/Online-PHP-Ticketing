<?php

session_start();

require_once "./inc/_functions.php";

if (!isset($_SESSION["token"]))
{
    session_destroy();
    header("Location: ../");
    exit();
}

$data = [
    "token" => $_SESSION["token"]
];
$json = json_encode($data);

// Location de l'API
$destination = activePath() . "/../../auth/api/logout";

// Reponse de l'API
[$response, $httpCode] = responseToRequest($destination, $json, "GET");


header('Content-Type: application/json');
echo json_encode($response);

// Si la requete passe, la manip de la bdd a ete faite donc on redirige
if ($response["status"] === "success")
{
    session_destroy();
    header("Location: ../");
    exit();
}