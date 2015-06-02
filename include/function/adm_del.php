<?php
function faq(){
	if (isset($_GET['faq'])){
		include_once '../database.php';
		$db = BDD();
		$faq = $_GET['faq'];
		$del_faq = $db -> prepare('DELETE FROM faq WHERE id = :id');
		$del_faq -> execute(array('id' => $faq));
		echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information ! </h4>';
	  echo "<p>La foire aux questions a bien &eacute;t&eacute; supprim&eacute;.</p></div>";
		header('Refresh: 4; adm_faq.php'); 
	}
}
function ticket(){
	if (isset($_GET['ticket'])){
		include_once '../database.php';
		$db = BDD();
		$verif_message = $db -> prepare('SELECT count(*) as nbr FROM message WHERE idTicket = :idTicket'); //  on verifie si le ticket possede
		$verif_message -> execute(array('idTicket' => $_GET['ticket']));								   //   des messages.
		$reponse1 = $verif_message->fetch();															   //
		if ($reponse1['nbr'] == 0){  // si il n'en possede pas on le supprime
			$del_ticket = $db -> prepare('DELETE FROM ticket WHERE id = :id');
			$del_ticket -> execute(array('id' => $_GET['ticket']));
			echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information !</h4>
			<p>Le ticket a bien &eacute;t&eacute; supprim&eacute;.</p></div>';
			header('Refresh: 4; adm_tickets.php');
		}else{		
		// si non on supprime les messages et ensuite on supprime le ticket
			$message = $db -> prepare('SELECT * FROM message WHERE idTicket = :idTicket');
			$message -> execute(array('idTicket' => $_GET['ticket']));
			while ($reponse2 = $message->fetch()){
				$del_message = $db -> prepare('DELETE FROM message WHERE id = :id');
				$del_message -> execute(array('id' => $reponse2['id']));
				$del_ticket = $db -> prepare('DELETE FROM ticket WHERE id = :id');
			$del_ticket -> execute(array('id' => $_GET['ticket']));
			echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information !</h4>
			<p>Le ticket et les messages on bien &eacute;t&eacute; supprim&eacute;.</p></div>';
			header('Refresh: 4; adm_tickets.php');
			}
		}
	}
}
function user(){
	if (isset($_GET['user'])){
		include_once '../database.php';
		$db = BDD();
		$del_user = $db -> prepare('DELETE FROM user WHERE id = :id');
		$del_user -> execute(array('id' => $_GET['user']));
		echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information !</h4>';
	  echo "<p>L'utilisateur a bien &eacute;t&eacute; supprim&eacute;.</p></div>";
		header('Refresh: 4; adm_user.php'); 
	}
}
	
function message(){
	if (isset($_GET['message'])){
		include_once '../database.php';
		$db = BDD();
		$del_message = $db -> prepare('DELETE FROM message WHERE id = :id');
		$del_message -> execute(array('id' => $_GET['message']));
		echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information !</h4>
	  <p>Votre message a bien &eacute;t&eacute; supprim&eacute;.</p></div>';
		header('Refresh: 4; index.php'); 
	}
}
function cat(){
	if (isset($_GET['cat'])){
		include_once '../database.php';
		$db = BDD();
		$del_message = $db -> prepare('DELETE FROM categorie WHERE id = :id');
		$del_message -> execute(array('id' => $_GET['cat']));
		echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
			<h4>Information !</h4>
	  <p>La categorie a bien &eacute;t&eacute; supprim&eacute;.</p></div>';
		header('Refresh: 4; adm_cat.php');
	}
}
?>

