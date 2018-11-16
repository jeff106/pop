<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';

session_start();
// récupération des utilisateurs
$query = $pdo->prepare(
    '
    SELECT id, firstname, lastname, address, zip_code, city, phone, email, validation, staff, function
    FROM user
    '
);
$query->execute();
$users = $query->fetchAll();

// récupération des articles
$query = $pdo->prepare(
    '
    SELECT id, title, content, photo
    FROM new
    '
);
$query->execute();
$news = $query->fetchAll();

// récupération des articles
$query = $pdo->prepare(
    '
    SELECT id, title, content, photo
    FROM new
    '
);
$query->execute();
$news = $query->fetchAll();

$template = 'pop_admin';
include '../layout.phtml';