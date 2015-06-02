<?php

function liste_ticket_user(){
    if (isset($_GET['iduser'])){
					include_once '../database.php';
					$db = BDD();
					$req_list = $db -> prepare('SELECT * FROM ticket WHERE idUser = :idUser'); //recuperation de la base de donnée trier par l'id de l'utilisateur
					$req_list -> execute(array('idUser' => $_GET['iduser']));
					while ($reponse_liste = $req_list->fetch()){ // on recupère tout
						$idtick = $reponse_liste['id'];
						$type = $reponse_liste['type'];
						$titre = $reponse_liste['titre'];
						$dates = $reponse_liste['dateCreation'];
						$req_status = $db -> prepare('SELECT * FROM statut WHERE id = :id');
						$req_status -> execute(array('id' => $reponse_liste['idStatut']));
						while ($reponse_statut = $req_status->fetch()){
							$statut_lib = $reponse_statut['libelle'];
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
								
								// on affiche les information
							
?>
			<tr> 
				<td><?php echo $type;?></td>
				<td><a href="tickets.php?ticket=<?php echo $idtick;?>"><?php echo $titre;?></a></td>
				<td><?php echo $libelle;?></td>
				<td><?php echo $statut_lib.' <span class="glyphicon glyphicon-'.$reponse_statut['icon'].'"></span>';?></td>
				<td><?php echo $dates;?></td>
			</tr>
<?php												
						}
					}
				}
    }
}
function ticket_affiche_user(){
    if (isset($_GET['ticket'])){
        include_once '../database.php';
     $db = BDD();
		$req_ticket_full = $db -> prepare('SELECT * FROM ticket WHERE id = :id'); // on recupère toutes les info consernant le ticket
		$req_ticket_full -> execute(array('id' => $_GET['ticket']));
		$reponse_ticket_full = $req_ticket_full->fetch();
		$req_ticket_cat = $db -> prepare('SELECT * FROM categorie WHERE id = :id'); // on récupère les info lié au ticket dans la table categorie
		$req_ticket_cat -> execute(array('id' => $reponse_ticket_full['idCategorie']));
		$reponse_ticket_cat = $req_ticket_cat->fetch();
		$req_ticket_statut = $db -> prepare('SELECT * FROM statut WHERE id = :id');
		$req_ticket_statut -> execute(array('id' => $reponse_ticket_full['idStatut'])); // on récupère les info lié au ticket dans la table status
		$reponse_ticket_statut = $req_ticket_statut->fetch();
		$req_ticket_user = $db -> prepare('SELECT * FROM user WHERE id = :id');
		$req_ticket_user -> execute(array('id' => $reponse_ticket_full['idUser']));// on récupère les info lié au ticket dans la table user
		$reponse_ticket_user = $req_ticket_user->fetch();
		if (empty($reponse_ticket_cat['idCategorie'])){
							$libelle = $reponse_ticket_cat['libelle'];
						}else{
							$req_pa = $db -> prepare('SELECT libelle FROM  categorie WHERE id = :idCategorie');
							$req_pa -> execute(array('idCategorie' => $reponse_ticket_cat['idCategorie']));
							$reponse = $req_pa->fetch();
							$libelle = $reponse_ticket_cat['libelle'].' ('.$reponse['libelle'].')';
						}
		if (($_COOKIE['user'] == $reponse_ticket_user['login']) || isset($_COOKIE['adm'])){
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li><a href="tickets.php"><?php echo $title;?></a></li>
  <li class="active"><?php echo $reponse_ticket_full['titre'];?></li>
 </ol>
<div class="panel panel-default">
	<div class="panel-heading">

		<h3><?php echo $reponse_ticket_full['titre'];?> <small><span style="float:right"><?php echo $libelle.' - '.$reponse_ticket_statut['libelle'].' <span class="glyphicon glyphicon-'.$reponse_ticket_statut['icon'].'"></span>';?></span></small></h3>
	</div>
	<div class="panel-body">
		<h4>Description</h4>
		<p><?php echo $reponse_ticket_full['description'];?></p>
	</div>
	<div class="panel-footer">
		<p><a href="profils.php?id=<?php echo $reponse_ticket_full['idUser'];?>"><?php echo $reponse_ticket_user['login'];?></a><span style="float:right"><?php echo $reponse_ticket_full['dateCreation'];?></span></p>
		<?php if (isset($_COOKIE['adm'])){ ?>
	<button  type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal<?php echo $_GET['ticket'];?>">Modifier Statut</button>
	<button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cat<?php echo $_GET['ticket'];?>">Modifier Categorie</button>
		<a  type="button" class="btn btn-danger btn-sm" href="adm_del.php?ticket=<?php echo $_GET['ticket'];?>">Supprimer le ticket</a>
		<?php } ?>
		
	</div>
</div>
<div class="modal fade" id="myModal<?php echo $_GET['ticket'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="POST" action="tickets.php?ticket=<?php echo $_GET['ticket'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $reponse_ticket_full['titre'];?></h4>
      </div>
      <div class="modal-body">
	  
        <label>Categorie</label>
				<select class="form-control" name="statut">
				<?php
					$db = BDD();
					$req = $db -> prepare('SELECT id, libelle FROM  statut');
					$req -> execute();
					while ($rep = $req->fetch()){
						echo '<option value="'.$rep['id'].'">'.$rep['libelle'].'</option>';
					}			
					if (isset($_POST['statut'])){
						$update = $db -> prepare('UPDATE ticket set idStatut = :idStatut WHERE id = :id');
						$update -> execute(array('idStatut' => $_POST['statut'], 'id' => $_GET['ticket'] ));
						header('Refresh: 1 ;url=tickets.php?ticket='.$_GET['ticket'].'');
					}
				?>
					
				</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="cat<?php echo $_GET['ticket'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="POST" action="adm_tickets.php?ticket=<?php echo $_GET['ticket'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $reponse_ticket_full['titre'];?></h4>
      </div>
      <div class="modal-body">
	  
				<label>Categorie</label>
				<select class="form-control" name="categorie">
				<?php
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
				
	
					if (isset($_POST['categorie'])){
						$update = $db -> prepare('UPDATE ticket set idCategorie = :idCat WHERE id = :id');
						$update -> execute(array('idCat' => $_POST['categorie'], 'id' => $_GET['ticket'] ));
						header('Refresh: 1 ;url=tickets.php?ticket='.$_GET['ticket'].'');
					}
				?>
					
				</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<?php
        
    }
}
}
function message_count(){
    if (isset($_GET['ticket'])){
        		
		$db = BDD();
		$req_message_nbr = $db -> prepare('SELECT count(*) as nbr FROM message WHERE idTicket = :id'); // on recupère toutes les info consernant le ticket
		$req_message_nbr -> execute(array('id' => $_GET['ticket']));
		$reponse_message_nbr = $req_message_nbr->fetch();
			if ($reponse_message_nbr['nbr'] != 0){
				$nbr_message = $reponse_message_nbr['nbr'];
			}else{
				$nbr_message = 0;
			}
		?>
			<h3><?php echo $nbr_message;?> Messages</h3>
			<?php
    }
}
function message_affichage(){
    if (isset($_GET['ticket'])){
        $db = BDD();
		$req_message_full = $db -> prepare('SELECT * FROM message WHERE idTicket = :id'); // on recupère toutes les info consernant le ticket
		$req_message_full -> execute(array('id' => $_GET['ticket']));
		while ($reponse_message_full = $req_message_full->fetch()){
			$req_message_user = $db -> prepare('SELECT * FROM user WHERE id = :id');
			$req_message_user -> execute(array('id' => $reponse_message_full['idUser']));
			$reponse_message_user = $req_message_user->fetch();
		?>
			<div class="panel panel-info">
				<div class="panel-heading" role="tab" id="heading<?php echo $reponse_message_full['id'];?>">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $reponse_message_full['id'];?>" aria-expanded="false" aria-controls="collapse<?php echo $reponse_message_full['contenu'];?>">
							<?php echo $reponse_message_user['login'];?>
							<span style="float:right"><?php echo $reponse_message_full['date'];?></span>
						</a>
						
					</h4>
				</div>
				<div id="collapse<?php echo $reponse_message_full['id'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $reponse_message_full['id'];?>">
					<div class="panel-body">
						<?php echo $reponse_message_full['contenu'];?>
					</div>
					<div class="panel panel-info panel-footer">
						<?php
							if (($_COOKIE['user'] == $reponse_message_user['login']) || (isset($_COOKIE['adm']))){
								?>
								<a href="tickets.php?ticket=<?php echo $_GET['ticket'];?>&edit=<?php echo $reponse_message_full['id'];?>" type="button" class="btn btn-warning btn-sm">Modifier</a>
								<?php
								if (isset($_COOKIE['adm'])){
								?>
								<a href="adm_del.php?message=<?php echo $reponse_message_full['id'];?>" type="button" class="btn btn-danger btn-sm">Supprimer</a>
							

								<?php
								}
							}					
						?>
					</div>
				</div>
				
			</div>
			<?php 
			}
    }
}
function ajouter_message(){
	if (isset($_POST['message'])){
		$addmessage = $db -> prepare('INSERT INTO message (contenu, idUser, idTicket) VALUES (:contenu, :idUser, :idTicket)');
		$addmessage -> execute(array('contenu' => $_POST['message'], 'idUser' => $_COOKIE['id'], 'idTicket' => $_GET['ticket'] ));
		header('Refresh: 1 ;url=adm_tickets.php?ticket='.$_GET['ticket'].'');
	}
}
function del_message(){
    ?>
    <div class="modal fade" id="del<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Merci de confirmer</h4>
      </div>
      <div class="modal-body">
	    Etes-vous certain de vouloir supprimer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
        <a type="button" class="btn btn-danger" href="adm_del.php?user=<?php echo $_GET['id'];?>">Oui</a>
      </div>
	  </form>
    </div>
  </div>
</div>
<?php
}
?>
