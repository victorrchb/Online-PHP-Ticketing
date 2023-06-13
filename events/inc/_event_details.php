<?php

session_start();

require_once "../auth/inc/_functions.php";

verifyToken();
verifyRequest();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

require_once "./inc/_pdo_billetterie.php";

$request = $pdo->prepare("SELECT * FROM events WHERE id=:id");
$request->execute([
    ":id" => $id
]);
$event = $request->fetch(PDO::FETCH_ASSOC);

if ($event["image"] == null)
{
    $event["image"] = "../resources/img/placeholder.jpg";
}
if ($event["description"] == null)
{
    $event["description"] = "Pas de description";
}
$date = substr($event["date"], 0, 10);
$time = substr($event["date"], 11, 5);

// TICKETS

$request = $pdo->prepare("SELECT * FROM tickets WHERE event_id=:id");
$request->execute([
    ":id" => $id
]);
$results = $request->fetchAll(PDO::FETCH_ASSOC);
$isNotEmpty = !empty($results);
if ($isNotEmpty)
{
    $tickets = $results;
}
else
{
    $tickets = null;
}
