<?php

// Recupere le json passe en POST
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data["login"]) && isset($data["password"]))
{  
    if (is_string($data["login"]) && is_string($data["password"]))
    {
        // Preparation de PDO
        require_once "./inc/_pdo_authentification.php";
        $request = $pdo->prepare("SELECT * FROM users WHERE login = :login");
        $request->execute([
            ":login" => $data["login"]
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);

        // Identifiants corrects
        if (password_verify($data["password"], $result["password"]))
        {
            // Suprrime tout les jetons de l'utilisateur pour ne pas avoir des jetons qui traine (si l'utilisateur ferme le navigateur sans se déconnecter)
            $request = $pdo->prepare("DELETE FROM tokens WHERE login=:login");
            $request->execute([
                ":login" => $data["login"]
            ]);
            // Création du jeton
            $token = bin2hex(random_bytes(12));
            $request = $pdo->prepare("INSERT INTO tokens VALUES (:token, :login)");
            $request->execute([
                ":token" => $token,
                ":login" => $data["login"]
            ]);
            http_response_code(200);
            $response = array(
                "status" => "success",
                "message" => $token
            );
        }
        else
        {
            http_response_code(401);
            $response = array(
                "status" => "error",
                "message" => "Identifiants incorrects"
            );
        }
    }
    else
    {
        http_response_code(400);
        $response = array(
            "status" => "error",
            "message" => "incorrect JSON"
        );
    }
}
else
{
    http_response_code(400);
    $response = array(
        "status" => "error",
        "message" => "incorrect JSON"
    );
}

// Ecriture du fichier
header('Content-Type: application/json');
echo json_encode($response);