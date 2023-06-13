<?php

session_start();

require_once "../auth/inc/_functions.php";
require_once "./inc/_functions.php";

verifyToken();
verifyRequest();

$error = null;

// Recupere les anciennes donnees
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require_once "./inc/_pdo_billetterie.php";
$request = $pdo->prepare("SELECT * FROM events WHERE id=:id");
$request->execute([
    ":id" => $id
]);
$event = $request->fetch(PDO::FETCH_ASSOC);

isEventCanceled($event, "./dashboard");

$date = substr($event["date"], 0, 10);
$time = substr($event["date"], 11, 5);

// Submit des nouvelles donnees
if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $name = filter_input(INPUT_POST, "name");
    $description = filter_input(INPUT_POST, "description");
    $image = filter_input(INPUT_POST, "image");
    $date = filter_input(INPUT_POST, "date") . " " . filter_input(INPUT_POST, "time") . ":00";

    if (!$name || !$date)
    {
        $error = "Attention aux champs obligatoires !";
    }
    else
    {
        if ($description == "")
        {
            $description = NULL;
        }
        if ($image == "")
        {
            $image = NULL;
        }

        $request = $pdo->prepare("
            UPDATE events
            SET name=:name, description=:description, image=:image, date=:date
            WHERE id=:id
        ");
        $request->execute([
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":date" => $date,
            ":id" => $id
        ]);

        header("Location: ./dashboard");
        exit();
    }
}