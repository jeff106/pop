<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
//include PATH_SITE . 'application/bdd_connection.php';


//recuperer les info du president
$query = $pdo->prepare(
    "
    SELECT CONCAT(firstname, lastname) AS name, CONCAT(address, ' ',zip_code, ' ',city) AS address, phone, email, function, photo
    FROM user
    WHERE id IN ('1', '2', '4')
    "
);
$query->execute();
$contacts = $query->fetchAll();
$template = 'contact';
include '../layout.phtml';