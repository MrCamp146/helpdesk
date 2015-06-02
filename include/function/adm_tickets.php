
				<?php
					include_once './include/database.php';
function liste_adm_ticket(){
					$db = BDD();
					$req_list = $db -> prepare('SELECT * FROM ticket'); //recuperation de la base de donnée trier par l'id de l'utilisateur
					$req_list -> execute(array());
					while ($reponse_liste = $req_list->fetch()){ // on recupère tout
						$idtick = $reponse_liste['id'];
						$type = $reponse_liste['type'];
						$titre = $reponse_liste['titre'];
						$dates = $reponse_liste['dateCreation'];
						$req_status = $db -> prepare('SELECT * FROM statut WHERE id = :id');
						$req_status -> execute(array('id' => $reponse_liste['idStatut']));
						while ($reponse_statut = $req_status->fetch()){
							$statut_lib = $reponse_statut['libelle'];
							if ($reponse_statut['id'] == 1){
								$class = 'class="info"';
							}else{
								$class = "";
							}
							$req_categorie = $db -> prepare('SELECT * FROM categorie WHERE id = :id');
							$req_categorie -> execute(array('id' => $reponse_liste['idCategorie']));
							while ($reponse_categorie = $req_categorie->fetch()){
								
								if (empty($reponse_categorie['idCategorie'])){
									$libelle = $reponse_categorie['libelle'];
								}else{
									$req_pa = $db -> prepare('SELECT libelle FROM  categorie WHERE id = :idCategorie');
									$req_pa -> execute(array('idCategorie' => $reponse_categorie['idCategorie']));
									$reponse = $req_pa->fetch();
									$libelle = $reponse_categorie['libelle'].' ('.$reponse['libelle'].')';
								}
								$req_user = $db -> prepare('SELECT * FROM user WHERE id = :id');
								$req_user -> execute(array('id' => $reponse_liste['idUser']));
								while ($reponse_user = $req_user->fetch()){
									$login = $reponse_user['login'];
								
								// on affiche les information
							
?>
			<tr <?php echo $class;?>> 
				<td><?php echo $type;?></td>
				<td><a href="tickets.php?ticket=<?php echo $idtick;?>"><?php echo $titre;?></a></td>
				<td><?php echo $login;?></td>
				<td><?php echo $libelle;?></td>
				<td><?php echo $statut_lib.' <span class="glyphicon glyphicon-'.$reponse_statut['icon'].'"></span>';?></td>
				<td><?php echo $dates;?></td>
			</tr>
<?php						}				
						}
					}
				}
}
				?>
	