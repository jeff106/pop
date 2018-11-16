<?php
	//	Connexion à la base de données
try {
	$pdo = new PDO
	(
		'mysql:host=127.0.0.1;dbname=pop;charset=UTF8',
		'root',
		'',
	    [
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	    ]
	);
	if($pdo === null) {
		throw new Exception('la connexion a échouée', 1);
	}

} catch (Exception $e) {
	echo $e ->getMessage();
}