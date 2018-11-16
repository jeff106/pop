<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';

session_start();
//var_dump($_SESSION); die;
//var_dump($_POST); die;
//Ajout du commentaire en base de données
if(isset($_POST) || !empty($_POST)){
    try {
        $query = 
        '
        INSERT INTO new_comment
                (new_id, user_id, content, created_at)
        VALUES (:new_id, :user_id, :content,  NOW())
        '
        ;
        $insert = $pdo->prepare($query);
        $insert->execute(
            [
                ':new_id'     => $_POST['id'],
                ':user_id'    => $_SESSION['user']['id'],
                ':content'    => $_POST['content']
            ]
        );
    } 
    catch (DomainException $e) {
        echo $e ->getMessage();
    }
}
else {
    throw new DomainException('Erreur lors de l\'enregistrement de votre commentaire');
}
header('Location: ' . REQUEST_SITE . 'show_new.php?id=' . $_POST['id']);
exit();