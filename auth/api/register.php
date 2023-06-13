<?php

// Recupere le json passe en POST
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Verifie le contenu du json passe en POST et repond en fonction
if (isset($data["login"]) && isset($data["password"]))
{  
    if (is_string($data["login"]) && is_string($data["password"]))
    {
        // Preparation de PDO
        require_once "./inc/_pdo_authentification.php";

        // On verifie s'il y a un autre utilisateur qui a déjà le nom de login souhaité
        $request = $pdo->prepare("SELECT login FROM users WHERE login=:login");
        $request->execute([
            ":login" => $data["login"]
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        // $isNotEmpty regarde s'il y a du contenu dans le resultat et prend 'true' ou 'false' en fonction
        $isNotEmpty = !empty($result);

        if ($isNotEmpty)
        {
            http_response_code(406);
            $response = array(
                "status" => "error",
                "message" => "Cet identifiant est déjà pris"
            );
        }
        else
        {
            $request = $pdo->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
            $request->execute([
                ":login" => $data["login"],
                ":password" => password_hash($data["password"], PASSWORD_DEFAULT)
            ]);

            http_response_code(200);
            $response = array(
                "status" => "success",
                "message" => ""
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
?>