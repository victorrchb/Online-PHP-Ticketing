<?php

$data = [
    "token" => "9e54e63bab347fa71f8fec71"
];

if (isset($data["token"]))
{
    if (is_string($data["token"]))
    {
        // Preparation de PDO
        require_once "./api/inc/_pdo_authentification.php";
        // On regarde si le token existe dans la bdd
        $request = $pdo->prepare("SELECT * FROM tokens WHERE token=:token");
        $request->execute([
            ":token" => $data["token"]
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        // $isNotEmpty regarde s'il y a du contenu dans le resultat et prend 'true' ou 'false' en fonction
        $isNotEmpty = !empty($result);
        if ($isNotEmpty)
        {
            // Si le token existe, on le supprime
            // $request = $pdo->prepare("DELETE FROM tokens WHERE token=:token");
            // $request->execute([
            //     ":token" => $data["token"]
            // ]);

            http_response_code(200);
            $response = array(
                "status" => "success",
                "message" => ""
            );
        }
        else
        {
            http_response_code(401);
            $response = array(
                "status" => "error",
                "message" => "Jeton inconnu"
            );
        }

        
    } else {
        http_response_code(400);
        $response = array(
            "status" => "error",
            "message" => "JSON incorrect"
        );
    }
}
else
{
    http_response_code(400);
    $response = array(
        "status" => "error",
        "message" => "JSON incorrect"
    );
}

// Ecriture du fichier

header('Content-Type: application/json');
echo json_encode($response);