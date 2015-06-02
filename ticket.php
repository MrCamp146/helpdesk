<?php
$title = "Ajouter un ticket";
include_once 'header.php';
include_once './include/function/ticket.php';
Addticket();
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li class="active"><?php echo $title;?></li>
 </ol>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Ajouter un tictet</h3>
	</div>
	<form method="POST" action="ticket.php">
		<div class="panel-body">
				<label>Type</label>
				<select class="form-control" name="type">
					<option value="demande">Demande</option>
					<option value="incident">Incident</option>
				</select>
				<label>Categorie</label>
				<select class="form-control" name="categorie">
				<?php
					liste_cat();
				?>
					
				</select>
				<label>Titre</label>
				 <input type="text" class="form-control" name="titre" placeholder="Titre">
				 <label>Description</label>
				 <textarea class="form-control" rows="2" name="description"></textarea>
				 <label>Login</label>
				 <input type="text" class="form-control" name="login" placeholder="<?php echo $_COOKIE['user'];?>" disabled>
				 <label>Date de creation</label>
				 <input type="text" class="form-control" name="date" placeholder="<?php echo date("d-m-Y");?>" disabled>
				 <label>Status</label>
				 <input type="text" class="form-control" name="status" placeholder="Nouveau" disabled>
				 
		</div>
		<div class="panel-footer">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
		</div>
	</form>
</div>
<?php
include_once 'footer.php';
?>