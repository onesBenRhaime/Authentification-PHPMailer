<?php
    try
	{
		// On se connecte � MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=paf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arr�te tout
			die('Erreur : '.$e->getMessage());
			echo "erreur";
	}

?>