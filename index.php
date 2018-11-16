<?php
require_once 'configuration/constant.php';
include 'configuration/bdd_connection.php';
session_start();

// 1 - Requête qui va récup les disciplines a afficher sur la page d'accueil
$query = $pdo->prepare(
    '
    SELECT name, photo, content
    FROM discipline
    '
);
// 2 - Execution de la requête
$query->execute();
// 3 - Récupération des resultats
$disciplines = $query->fetchAll();

// Requete qui va récupérer les 3 dernieres news

$query = $pdo->prepare(
    '
    SELECT id, title, created_at, content
    FROM new
    ORDER BY created_at DESC
    LIMIT 3
    '
);
$query->execute();
$news = $query->fetchAll();

$template = 'index';
include 'layout.phtml';