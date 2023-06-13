<?php

require_once "../auth/inc/_functions.php";

$error = null;
$page = "form";

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $firstname = filter_input(INPUT_POST, "firstname") ?? null;
    $lastname = filter_input(INPUT_POST, "lastname") ?? null;
    $privateId = filter_input(INPUT_POST, "id") ?? null;

    if ($firstname !== null || $lastname !== null || $privateId !== null)
    {
        require_once "../events/inc/_pdo_billetterie.php";
        $request = $pdo->prepare("SELECT * FROM tickets WHERE user_id=:privateId AND user_firstname=:firstname AND user_lastname=:lastname");
        $request->execute([
            ":privateId" => $privateId,
            ":firstname" => $firstname,
            ":lastname" => $lastname
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $isNotEmpty = !empty($result);
        if ($isNotEmpty)
        {
            $page = "ticket";
            $ticket = $result;

            $request = $pdo->prepare("SELECT name, date FROM events WHERE id=:eventId");
            $request->execute([
                ":eventId" => $ticket["event_id"],
            ]);
            $event = $request->fetch(PDO::FETCH_ASSOC);
            $variables = "name=" . urlencode($firstname . $lastname) . "&code=" . urlencode($ticket["id"]);
            $qrCodeURL = activePath() . "../../../validate?" . $variables;
        }
        else
        {
            // Cas d'erreur
            http_response_code(400);
            $error = "Les informations saisies ne correspondent à aucun ticket";
        }
    }
    else
    {
        // Cas d'erreur
        http_response_code(400);
        $error = "Remplir les champs obligatoires";
    }
}