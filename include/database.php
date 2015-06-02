<?php

function BDD(){
	//création de la fonction BDD affin de crée une seul fois la requete de connection a la base de donnée.
	include 'config.php';
try
	{
	$db = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_NAME.'', $DB_USER, $DB_PASS);
	return $db;
	}
	catch (Exception $e)
	{
    	    die('Erreur : ' . $e->getMessage());
	}
}
?>