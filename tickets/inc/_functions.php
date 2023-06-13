<?php

// Recupere les donnees de l'event
function getEventData($pdo, $event_id) {
    $request = $pdo->prepare("SELECT * FROM events WHERE id=:id");
    $request->execute([
        ":id" => $event_id
    ]);
    $event = $request->fetch(PDO::FETCH_ASSOC);

    return $event;
}

function randomAlphaNum($length) {
    // Génération de variables aléatoires :
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Liste des caractères possibles
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $randomString;
}