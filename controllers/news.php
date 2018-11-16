<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
//include PATH_SITE . 'application/bdd_connection.php';
//Récupération des articles
$query = $pdo->prepare(
    '
    SELECT n.id, category_id, title, content, photo, created_at, name
    FROM new n
    INNER JOIN category cat ON cat.id = category_id
    '
);
$query->execute();
$news = $query->fetchAll();
$template = 'news';
include '../layout.phtml';