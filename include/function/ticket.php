<?php

include_once './include/database.php';
function Addticket(){
if (isset($_POST['type']) and isset($_POST['categorie']) and isset($_POST['titre']) 
	and isset($_POST['description'])){
	
	$db = BDD();
	$req_ticket = $db -> prepare('INSERT INTO ticket (type, idCategorie, titre, description, idUser ) 
									VALUES (:type, :idCategorie, :titre, :description, :idUser)');
	$req_ticket -> execute(array('type' => $_POST['type'],
								'idCategorie' => $_POST['categorie'],
								'titre' => $_POST['titre'],
								'description' => $_POST['description'],
								'idUser' => $_COOKIE['id']));
								echo '
								<div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
						<h4>Information !</h4>
      <p>Votre ticket a bien &eacute;t&eacute; envoy&eacute;.</p></div>
     ';
	header('Refresh: 4; index.php'); 
	
}
}
function liste_cat(){
					$db = BDD();
					$req = $db -> prepare('SELECT * FROM  categorie');
					$req -> execute();
					while ($rep = $req->fetch()){
						if (empty($rep['idCategorie'])){
							echo '<option value="'.$rep['id'].'">'.$rep['libelle'].'</option>';
						}else{
							$req_pa = $db -> prepare('SELECT libelle FROM  categorie WHERE id = :idCategorie');
							$req_pa -> execute(array('idCategorie' => $rep['idCategorie']));
							$reponse = $req_pa->fetch();
							echo '<option value="'.$rep['id'].'">'.$rep['libelle'].' ('.$reponse['libelle'].')</option>';
						}
						
					}			
}
					

?>