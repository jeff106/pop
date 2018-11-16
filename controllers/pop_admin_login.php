<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
//var_dump($_SESSION); die;
if(isset($_POST) && !empty($_POST)) {
    $query = $pdo->prepare(
        '
        SELECT id, firstname, lastname, email, password
        FROM user
        WHERE id = 1
        '
    );
    $query->execute();
    $admin = $query->fetch();
    //var_dump($admin); die;
    if(in_array($_POST['email'], $admin)) {
        if(password_verify($_POST['password'], $admin['password'])) {
            session_start();
            $_SESSION['admin'] = 
            [
                'id'            => $admin['id'],
                'firstName'     => $admin['firstname'],
                'lastName'      => $admin['lastname'],
                'email'         => $admin['email']
            ];
        header('Location: ' . REQUEST_SITE . 'pop_admin.php');
        exit();    
        }
        else {
            throw new DomainException
            (
                'erreur lors de la saisie du mot de passe'
            );
        }
    }
    else {
        throw new DomainException
        (
            'aucun compte administrateur n\'est associé à cette email'
        );
        header('Location: ' . PATH_SITE . 'index.php');
        exit();
    }
}

$template = 'pop_admin_login';
include '../layout.phtml';