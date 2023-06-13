<?php

session_start();

require_once "../auth/inc/_functions.php";

verifyToken();
verifyRequest();

require_once "./inc/_pdo_billetterie.php";

$request = $pdo->prepare("SELECT * FROM events");
$request->execute();
$results = $request->fetchAll(PDO::FETCH_ASSOC);
$isNotEmpty = empty($results);
if ($isNotEmpty) {
    $events = null;
} else {
    $events = $results;
}