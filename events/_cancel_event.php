<?php

session_start();

require_once "../auth/inc/_functions.php";

verifyToken();
verifyRequest();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

require_once "./inc/_pdo_billetterie.php";
$request = $pdo->prepare("UPDATE events SET active=0 WHERE id=:id");
$request->execute([
    ":id" => $id
]);

header("Location: ./dashboard");
exit();