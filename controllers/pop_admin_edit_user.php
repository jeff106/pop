<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';

session_start();
//recupération des information de l'utilisateur
if(empty($_POST)) {
    if(!array_key_exists('id', $_GET) OR !ctype_digit($_GET['id']))
        {
            header('Location: ' . PATH_SITE . 'pop_admin.php');
            exit();
        }
    $query = $pdo->prepare(
        '
        SELECT *
        FROM user
        WHERE id = :id
        '
    );
    $query->execute(array(':id' => $_GET['id']));
    $user = $query->fetch();

    $template = 'pop_admin_edit_user';
    include '../layout.phtml';
}
else {
    //modification des informations de l'utilisateur

    $query = $pdo->prepare(
        '
        UPDATE
            user
        SET
            firstname   = :firstname,
            lastname    = :lastname,
            address     = :address,
            zip_code    = :zip_code,
            city        = :city,
            phone       = :phone,
            email       = :email,
            validation  = :validation,
            staff       = :staff,
            function    = :function
        WHERE
            id          = :id
        '
    );
    $query->execute(
        array(
            ':firstname'       => $_POST['firstName'], 
            ':lastname'        => $_POST['lastName'],
            ':address'         => $_POST['address'],
            ':zip_code'        => $_POST['zipCode'],
            ':city'            => $_POST['city'],
            ':phone'           => $_POST['phone'],
            ':email'           => $_POST['email'],
            ':validation'      => $_POST['validation'],
            ':staff'           => $_POST['staff'],
            ':function'        => $_POST['function'],
            ':id'              => $_GET['id']
        )
    );
    //retour à la page de gestion des utilisateurs
    $template = 'pop_admin';
    include '../layout.phtml';
}


