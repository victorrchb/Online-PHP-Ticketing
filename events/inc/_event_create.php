<?php

session_start();

require_once "../auth/inc/_functions.php";

verifyToken();
verifyRequest();

$error = null;

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST")
{
    
    verifyRequest();
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

        require_once "./inc/_pdo_billetterie.php";
        $request = $pdo->prepare("INSERT INTO events (name, description, image, date) VALUES (:name, :description, :image, :date)");
        $request->execute([
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":date" => $date,
        ]);

        header("Location: ./dashboard");
        exit();
    }
}