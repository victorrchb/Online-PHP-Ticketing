<?php

session_start();

require_once "../auth/inc/_functions.php";
require_once "../events/inc/_functions.php";
require_once "./inc/_functions.php";

verifyToken();
verifyRequest();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$error = null;

require_once "../events/inc/_pdo_billetterie.php";
$event = getEventData($pdo, $id);
isEventCanceled($event, "../dashboard");

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $firstname = filter_input(INPUT_POST, "firstname");
    $lastname = filter_input(INPUT_POST, "lastname");
    $mail = filter_input(INPUT_POST, "mail");

    if (!$lastname || !$firstname || !$mail)
    {
        $error = "Attention aux champs obligatoires !";
    }
    else
    {
        $request = $pdo->prepare("INSERT INTO tickets (id, event_id, user_id, user_firstname, user_lastname, user_mail) VALUES (:id, :event_id, :user_id, :firstname, :lastname, :mail)");
        $request->execute([
            ":id" => randomAlphaNum(32),
            ":event_id" => $id,
            ":user_id" => randomAlphaNum(rand(6, 10)),
            ":firstname" => $firstname,
            ":lastname" => $lastname,
            ":mail" => $mail,
        ]);
        header("Location: ../events/event_details?id=" . $id . ".php");
        exit();
    }
}