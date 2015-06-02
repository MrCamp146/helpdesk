<?php
$title = "Suppression";
include_once 'header.php';
$_GET['faq']; 
$_GET['ticket'];
$_GET['user'];
$_GET['message'];

include_once './include/function/adm_del.php';
$db = BDD();
if (!isset($_COOKIE['adm'])){ //on verifie que l'utilisateur est connecter.
	//si non
	echo "<div class='alert alert-info'>Vous n'êtes pas Administrateur, vous ne pouvez donc accéder a cette pagges.</div>";
	header('Refresh: 2, url=index.php'); // on le renvois sur la pages d'accueil.
}else{
	if (isset($_GET['faq'])){
		faq();
	}
	if (isset($_GET['ticket'])){
		ticket();
	}
	if (isset($_GET['user'])){
		user();
	}
	
	if (isset($_GET['message'])){
		message();
	}
	if (isset($_GET['cat'])){
		cat();
	}
}
include_once 'footer.php';
?>