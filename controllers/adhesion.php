<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
//var_dump($_SERVER['PATH_INFO']); die;
//var_dump(PATH_SITE); die;
//var_dump($_POST); die;
/*
array (size=10)
  'gender' => string 'Homme' (length=5)
  'firstName' => string 'Mario' (length=5)
  'lastName' => string 'Bros' (length=4)
  'dateOfBirth' => string '13.08.2007' (length=10)
  'address' => string '20 ure de l étoile' (length=19)
  'zipCode' => string '60000' (length=5)
  'city' => string 'star' (length=4)
  'email' => string 'mario@mario.fr' (length=14)
  'password' => string 'mdp' (length=3)
  'sport' => string 'paddle' (length=6)
*/
if(!empty($_POST)) {
    try {
        // Convert date fr to us
        //var_dump(implode('-', array_reverse(explode('.', $_POST['dateOfBirth'])))); die;
        $newDate = implode('-', array_reverse(explode('.', $_POST['dateOfBirth'])));
        
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = 
            '
            INSERT INTO user
        	        (firstname, lastname, date_of_birth, gender, discipline_id, address, zip_code, city, phone, email, password, validation, created_at)
            VALUES (:firstname, :lastname, :date_of_birth, :gender, :discipline_id, :address, :zip_code, :city, :phone, :email, :password, :validation, NOW())'
        ;
        $insert = $pdo->prepare($query);
        $insert->execute(
            [
                ':firstname'        => $_POST['firstName'],
                ':lastname'         => $_POST['lastName'],
                ':date_of_birth'    => $newDate,
                ':gender'           => $_POST['gender'],
                ':discipline_id'    => $_POST['sport'],
                ':address'          => $_POST['address'],
                ':zip_code'         => $_POST['zipCode'],
                ':city'             => $_POST['city'],
                ':phone'            => $_POST['phone'],
                ':email'            => $_POST['email'],
                ':password'         => $password,
                ':validation'       => $_POST['validation']
            ]
        );
        header('Location: ' . PATH_SITE . 'index.php');
        exit();
    }
    catch (DomainException $e) {
       echo $e ->getMessage();
    }
} else {
    $template = 'adhesion';
    include '../layout.phtml';
}
    
    
