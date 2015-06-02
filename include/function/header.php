<?php
function User_verif(){
	if (isset($_COOKIE['id'])){
	include_once "./include/database.php";
			$db = BDD();
			$req_verif_info = $db -> prepare('SELECT * FROM user WHERE id = :id');
			$req_verif_info -> execute(array('id' => $_COOKIE['id']));
			$reponse_verif = $req_verif_info->fetch();
			if (empty($reponse_verif['nom'])){
				echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
						<h4>Information !</h4>
		<p>Veuiller modifier vos information de votre profil, il manque des donn&eacute;es.</p>
		<p>
			<a href="profils.php?id='.$reponse_verif['id'].'" type="button" class="btn btn-danger">Votre profils</a>
		</p>
		</div>';
				}elseif (empty($reponse_verif['prenom'])) {
				echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
						<h4>Information !</h4>
		<p>Veuiller modifier vos information de votre profils, il manque des donn&eacute;e.</p>
		<p>
			<a href="profils.php?id='.$reponse_verif['id'].'" type="button" class="btn btn-danger">Votre profils</a>
		</p>
		</div>';
		}
	}
}
?>      	