<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
session_start();
//include PATH_SITE . 'application/bdd_connection.php';

//var_dump($_GET); die;
if(!array_key_exists('id', $_GET) OR !ctype_digit($_GET['id']))
    {
        header('Location: ' . PATH_SITE . 'index.php');
        exit();
    }
//Recuperation et affichage de l'article provenant de la chaine de requete
$query = $pdo->prepare(
    '
    SELECT n.category_id, cat.name, title, content, photo, created_at 
    FROM new n
    INNER JOIN category cat ON cat.id = n.category_id
    WHERE n.id = :id
    '
);

$query->execute(array(':id' => $_GET['id']));

$new = $query->fetch();

//récupération des commentaires associés à l'article
$query = $pdo->prepare(
    "
    SELECT user_id, content, nc.created_at, CONCAT(firstname, ' ', lastname) AS name
    FROM new_comment nc
    INNER JOIN user u ON u.id = nc.user_id
    WHERE nc.new_id = :id
    "
);

$query->execute(array(':id' => $_GET['id']));

$comments = $query->fetchAll();

$template = 'show_new';
include '../layout.phtml';