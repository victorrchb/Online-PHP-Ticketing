<?php

session_start();

require_once "../auth/inc/_functions.php";
require_once "../events/inc/_functions.php";
require_once "./inc/_functions.php";

verifyToken();
verifyRequest();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$ticket_id = filter_input(INPUT_GET, 'ticket_id', FILTER_SANITIZE_STRING);

require_once "../events/inc/_pdo_billetterie.php";

$event = getEventData($pdo, $id);
isEventCanceled($event, "../dashboard");

$request = $pdo->prepare("DELETE FROM tickets WHERE id=:id");
$request->execute([
    ":id" => $ticket_id
]);

header("Location: ../events/event_details?id=$id");
exit();