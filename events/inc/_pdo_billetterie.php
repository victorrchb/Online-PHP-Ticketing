<?php
$moteur = "mysql";
$hote = "localhost";
$port = 3306;
$nomBdd = "events";
$nomUtilisateur = "root";
$mdp = "";

$pdo = new PDO(
    "$moteur:host=$hote:$port;dbname=$nomBdd",
    $nomUtilisateur, $mdp
);