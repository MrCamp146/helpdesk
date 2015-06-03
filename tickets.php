<?php
$title = "Vos Tickets";
include 'header.php';
$_GET['iduser']; // pages pour la liste (tableau) des tickets des utilisateur.
$_GET['ticket'];
$_GET['edit']; // pages pour les detail d'un ticket et les messages.
include_once './include/database.php';

if (isset($_GET['iduser'])){ 
	if (!isset($_COOKIE['id'])){ //on verifie que l'utilisateur est connecter.
		//si non
		echo "<div class='alert alert-info'>Vous devez être connecter.</div>";
		header('Refresh: 2, url=index.php'); // on le renvois sur la pages d'accueil.
	}else{
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li class="active"><?php echo $title;?></li>
 </ol>
<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Vos tickets</h3>
	</div>
	<div class="panel-body">
		<script> // importation du module dataTable.
$(document).ready(function(){
	$('#exemple').dataTable();    
});
    </script>
        
          <table class="table table-striped table-bordered"  id="exemple">
          <thead>
          	<tr style="text-align:center;">
				<th>Type</th>
            	<th>Titre</th>
                <th>Categorie</th>
                <th>Status</th>
                <th>date</th>
            </tr>
            </thead>
            <tbody>
				<?php
				include_once './include/function/tickets.php';	
				liste_ticket_user();
				
				?>
			</tbody>
		  </table>
	</div>
</div>
<?php
}
}
if (isset($_GET['ticket'])){
if (!isset($_COOKIE['id'])){
		echo "<div class='alert alert-info'>Vous devez être connecter.</div>";
		header('Refresh: 2, url=index.php');
	}else{
	    include_once './include/function/tickets.php';
	ticket_affiche_user();	
	?>
<div class="panel panel-primary">
	<div class="panel-heading">
            <?php 
            message_count();
            ?>
	</div>
	<div class="panel-body">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php 
		message_affichage();
			?>
		</div>
	</div>
		<div class="panel-footer">
		<button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#message<?php echo $_GET['ticket'];?>">Ajouter un messages</button>
		<div class="modal fade" id="message<?php echo $_GET['ticket'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="POST" action="tickets.php?ticket=<?php echo $_GET['ticket'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter un Message au ticket : <?php echo $reponse_ticket_full['titre'];?></h4>
      </div>
      <div class="modal-body">
	  
        <label>Messages</label>
				<textarea class="form-control" row="2" name="message"></textarea>
				<?php
					if (isset($_POST['message'])){
						$db = BDD();
						$addmessage = $db -> prepare('INSERT INTO message (contenu, idUser, idTicket) VALUES (:contenu, :idUser, :idTicket)');
						$addmessage -> execute(array('contenu' => $_POST['message'], 'idUser' => $_COOKIE['id'], 'idTicket' => $_GET['ticket'] ));
						header('Refresh: 1 ;url=adm_tickets.php?ticket='.$_GET['ticket'].'');
					}
				?>
					
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
	</div>
</div>
<?php if (isset($_GET['edit'])){
$db = BDD();
	$info_up = $db -> prepare('SELECT * FROM message WHERE id = :id');
	$info_up -> execute(array('id' => $_GET['edit']));
	$info_up_rep = $info_up->fetch();
if (isset($_POST['contenue'])){
		$db = BDD();
		$update = $db -> prepare('UPDATE message SET contenu = :contenu WHERE id = :id');
		$update -> execute(array('contenu' => $_POST['contenue'],'id' => $_GET['edit']));
		header('Refresh: 2 ;url=tickets.php');
	}
?>
<form method="POST" action="tickets.php?ticket=<?php echo $_GET['ticket'].'&edit='.$_GET['edit'];?>">
<div class="panel panel-warning">
	
		<div class="panel-heading">
			<h3>Edition du message</h3>
		</div>
		<div class="panel-body">
			<label>Description</label>
				 <textarea class="form-control" rows="2" name="contenue"><?php echo $info_up_rep['contenu'];?></textarea>

		</div>
		<div class="panel-footer">
			<button class="btn btn-warning btn-block" type="submit">Envoyer</button>
		</div>
	
</div>
</form>

<?php
}


}
}
if (!isset($_GET['ticket']) and !isset($_GET['iduser'])){
	if (!isset($_COOKIE['id'])){
		echo "<div class='alert alert-info'>Vous devez être connecter.</div>";
		header('Refresh: 2, url=index.php');
	}else{
	header('Location: tickets.php?iduser='.$_COOKIE['id'].'');
	}
}
?>
<?php
include 'footer.php';
?>
