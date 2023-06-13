<?php

session_start();

require_once "./inc/_functions.php";

verifyLoggin();

$error = null;

if(filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $login = filter_input(INPUT_POST, "login") ?? null;
    $password = filter_input(INPUT_POST, "password") ?? null;
    $cpassword = filter_input(INPUT_POST, "cpassword") ?? null;

    if ($login !== null || $password !== null || $cpassword !== null)
    {
        if ($password === $cpassword)
        {
            // Donnees a envoye pour la requete à l'API
            $data = [
                "login" => $login,
                "password" => $password
            ];
            $json = json_encode($data);

            // Location de l'API
            $destination = activePath() . "../../api/register";
            
            // Reponse de l'API
            [$response, $httpCode] = responseToRequest($destination, $json, "POST");

            // Si la requete passe, l'ajout a la bdd a ete fait donc on redirige
            if ($response["status"] === "success")
            {
                header("Location: ./login");
                exit();
            }
            else
            {
                // Cas d'erreur
                http_response_code($httpCode);
                $error = $response["message"];
            }
        }
        else
        {
            // Cas d'erreur
            http_response_code(400);
            $error = "Le mot de passe de confirmation doit être identique";
        }
    } 
    else
    {
        // Cas d'erreur
        http_response_code(400);
        $error = "Remplir les champs obligatoires";
    }
}