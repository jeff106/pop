<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';


if(isset($_POST) && !empty($_POST)) {
    $query = $pdo->prepare(
        '
        SELECT id, firstname, lastname, email, password
        FROM user
        WHERE email = :email
        '
    );
    
    $query->execute(array(':email' => $_POST['email']));
    
    $user = $query->fetch();
    //var_dump(REQUEST_SITE); die;
    //var_dump(PATH_SITE); die;   
    if(in_array($_POST['email'], $user)) {
        if(password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['user'] = 
            [
                'id'            => $user['id'],
                'firstName'     => $user['firstname'],
                'lastName'      => $user['lastname'],
                'email'         => $user['email']
            ];
        
                header('Location: ' . REQUEST_SITE . 'utilisateur.php');
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
            'aucun compte utilisateur n\'est associé à cette email'
        );
        header('Location: ' . PATH_SITE . 'index.php');
        exit();
    }
}
    