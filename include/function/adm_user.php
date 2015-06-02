<?php
include_once './include/database.php';
function liste_adm_user(){
					
					$db = BDD();
					$req_list = $db -> prepare('SELECT * FROM user'); //recuperation de la base de donnée trier par l'id de l'utilisateur
					$req_list -> execute(array());
					while ($reponse_liste = $req_list->fetch()){ // on recupère tout
						$iduser = $reponse_liste['id'];
						$login = $reponse_liste['login'];
						$email = $reponse_liste['mail'];
						if ($reponse_liste['admin'] == 1){
							$admin = "Oui";
						}else{
							$admin = "Non";
						}
								// on affiche les information
							
?>
			<tr> 
				<td><a href="profils.php?id=<?php echo $iduser;?>"><?php echo $login;?></a></td>
				<td><?php echo $email;?></td>
				<td><?php echo $admin;?></td>
				<td></td>
				<td></td>

			</tr>
<?php							

				}
}
				?>
			
