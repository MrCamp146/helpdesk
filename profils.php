<?php
$title = "Profil";
include 'header.php';
$_GET['id'];
?>

<?php
include_once './include/database.php';
$db = BDD();
$req_user_info = $db -> prepare('SELECT * FROM user WHERE id = :id');
$req_user_info -> execute(array('id' => $_GET["id"]));
$reponse_user_info = $req_user_info->fetch();
if ($reponse_user_info['admin'] == 0){
	$rang = "Membre";
}else{
	$rang = "Administrateur";
}

?>
<ol class="breadcrumb">
  <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li><a href="#"><?php echo $title;?></a></li>
  <li><?php echo $reponse_user_info['login'];?></li>
 </ol>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3><?php echo $reponse_user_info['login'];?><small><span style="float:right;"><?php echo $rang;?></span></small></h3>
	</div>
	<div class="panel-body">
		<p>Identifiant : <?php echo $reponse_user_info['login'];?></p>
		<p>Nom : <?php if ($reponse_user_info['nom'] == null){ echo '<span class="glyphicon glyphicon-question-sign"></span>  Aucune information'; }else{
		echo $reponse_user_info['nom'];}?></p>
		<p>Prenom : <?php if ($reponse_user_info['prenom'] == null){ echo '<span class="glyphicon glyphicon-question-sign"></span>  Aucune information'; }else{
		echo $reponse_user_info['prenom'];}?></p>
		<p>Email : <?php echo $reponse_user_info['mail'];?></p>
		<p>Adresse IP : <?php echo $reponse_user_info['ip'];?></p>
		
		
	</div>
	<div class="panel-footer">
		<?php if (($_COOKIE['user'] == $reponse_user_info['login']) || (isset($_COOKIE['adm']))) {
		?>
		 <button  type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#mail<?php echo $_GET['id'];?>">Changer vos information</button>
		 <?php if (isset($_COOKIE['adm'])) {
		 ?>
		 <button  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admin<?php echo $_GET['id'];?>">Changer permission</button>

		 <button  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del<?php echo $_GET['id'];?>">Supprimer l'utilisateur</button>
		 <?php
		 }
		 }
		 ?>
	</div>
</div>
<div class="modal fade bs-example-modal-lg" id="mail<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<form method="POST" action="profils.php?id=<?php echo $_GET['id'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $reponse_user_info['login'];?></h4>
      </div>
      <div class="modal-body">
		<div class="container-fluid">
            <div class="row">
		<div class="col-md-6">
			<label>Nom</label>
				<textarea class="form-control" name="nom" rows="1" maxlength="20"><?php echo $reponse_user_info['nom'];?></textarea>
			<label>Prenom</label>
				<textarea class="form-control" name="prenom" rows="1" maxlength="20"><?php echo $reponse_user_info['prenom'];?></textarea>
		</div>
		<div class="col-md-6">
			<label>Email</label>
				<textarea class="form-control" name="mail" rows="1"><?php echo $reponse_user_info['mail'];?></textarea>
		</div>
				<?php
					
					if (isset($_POST['mail']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_SERVER['REMOTE_ADDR'])){
						$update = $db -> prepare('UPDATE user set mail = :mail, prenom = :prenom, nom = :nom, ip = :ip WHERE id = :id');
						$update -> execute(array('mail' => $_POST['mail'],'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'ip' => $_SERVER['REMOTE_ADDR'], 'id' => $_GET['id'] ));
						header('Refresh: 2 ;url=profils.php?id='.$_GET['id'].'');
					}
				?>
					
			</div></div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="admin<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="POST" action="profils.php?id=<?php echo $_GET['id'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $reponse_user_info['login'];?></h4>
      </div>
      <div class="modal-body">
	  
        <label>Permission</label>
				<select class="form-control" name="admin">
				<?php
					$db = BDD();
					$req = $db -> prepare('SELECT id, admin FROM user WHERE id = :id');
					$req -> execute(array('id' => $_GET['id']));
					while ($rep = $req->fetch()){
						echo '<option value="0">Membre</option>
						<option value="1">Administrateur</option>';
					}			
					if (isset($_POST['admin'])){
						$update = $db -> prepare('UPDATE user set admin = :admin WHERE id = :id');
						$update -> execute(array('admin' => $_POST['admin'], 'id' => $_GET['id'] ));
						header('Refresh: 2 ;url=profils.php?id='.$_GET['id'].'');
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
include 'footer.php';
?>