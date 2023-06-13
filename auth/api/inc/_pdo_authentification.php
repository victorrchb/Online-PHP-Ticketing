<?php

$moteur = "mysql";
$hote = "localhost";
$port = 3306;
$nomBdd = "authentification";
$nomUtilisateur = "root";
$mdp = "";

$pdo = new PDO(
    "$moteur:host=$hote:$port;dbname=$nomBdd",
    $nomUtilisateur, $mdp
);