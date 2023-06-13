<?php

// Recupere le json passe en POST
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data["token"]))
{  
    if (is_string($data["token"]))
    {
        // Preparation de PDO
        require_once "./inc/_pdo_authentification.php";

        $request = $pdo->prepare("SELECT login FROM tokens WHERE token=:token");
        $request->execute([
            ":token" => $data["token"]
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);

        // $isNotEmpty regarde s'il y a du contenu dans le resultat et prend 'true' ou 'false' en fonction
        $isNotEmpty = !empty($result);
        if ($isNotEmpty)
        {
            // Si le token correspond à un utilisateur
            http_response_code(200);
            $login = array(
                "login" => $result["login"]
            );
            $response = array(
                "status" => "success",
                "message" => "",
                "user" => $login
            );
        }
        else
        {
            http_response_code(401);
            $response = array(
                "status" => "error",
                "message" => "Jeton incorrect"
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