<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
//Insertion des membres du bureau dans la base de données
//requete qui va récuperer les information sur les membres du bureau
$query = $pdo->prepare(
    '
    SELECT CONCAT(firstname, lastname) AS name, CONCAT(address, zip_code, city) AS address, phone, email, function, photo
    FROM user
    WHERE staff = 1
    '
);
$query->execute();
$membres = $query->fetchAll();

$template = 'presentation';
include '../layout.phtml';