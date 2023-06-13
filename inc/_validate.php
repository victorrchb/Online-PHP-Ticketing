<?php

$error = null;

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    $name = filter_input(INPUT_POST, "firstname") . filter_input(INPUT_POST, "lastname");
    $code = filter_input(INPUT_POST, "code");

    header("Location: ./validate?name=" . urlencode($name) ."&code=" . urlencode($code));
    exit();
}

$name = urldecode(filter_input(INPUT_GET, 'name')) ?? null;
$code = urldecode(filter_input(INPUT_GET, 'code')) ?? null;

if ($name == null || $code == null)
{
    $ticketExists = null;
}
else
{
    require_once "./events/inc/_pdo_billetterie.php";
    $request = $pdo->prepare("SELECT * FROM tickets WHERE CONCAT(user_firstname, user_lastname)=:name AND id=:code");
    $request->execute([
        ":name" => $name,
        ":code" => $code
    ]);
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
    $isNotEmpty = !empty($results);
    if ($isNotEmpty)
    {
        http_response_code(200);
        $ticketExists = true;
    }
    else
    {
        http_response_code(401);
        $error = "Le billet n'existe pas";
        $ticketExists = false;
    }
}