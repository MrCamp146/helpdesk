<?php 
$title = "Foire aux Question";
include 'header.php';
// include_once './include/database.php';
include_once './include/function/faq.php';
$_GET['id'];
if (!isset($_GET['id'])){
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li class="active"><?php echo $title;?></li>
</ol>
<div class="col-md-7">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4>Sujet class&eacute;s par cat&eacute;gorie</h4>
		</div>
		<div class="panel-body">
			<table class="table table-striped">

			<?php 
				sujet_faq();
			?>
			

  <!-- Tab panes -->


</table>
		</div>
	</div>
</div>
<div class="col-md-5">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Sujet les plus populaires</h4>
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<?php
				faq_pop();
				?>
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Sujet les plus r&eacute;cents</h4>
		</div>
		<div class="panel-body">
			<table class="table">
			<?php
				new_faq();
			?>
			</table>
		</div>
	</div>
</div>
<?php
}else{
		$db = BDD();
		$req1 = $db ->prepare('SELECT * FROM faq WHERE id = '.$_GET['id'].'');
		$req1 -> execute();
		$rep1 = $req1->fetch();
		$req2 = $db -> prepare('SELECT libelle FROM categorie WHERE id = :id');
		$req2 -> execute(array('id' => $rep1['idCategorie']));
		$rep2 = $req2->fetch();
		$req3 = $db -> prepare('SELECT login FROM user WHERE id = :id');
		$req3 -> execute(array('id' => $rep1['idUser']));
		$rep3 = $req3->fetch();
	
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li><a href="faq.php"><?php echo $title;?></a></li>
  <li class="active"><?php echo $rep1['titre'];?></li>
</ol>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3>
			<?php echo $rep1['titre'];?>
			<small>
				<span style="float:right;">
					<?php echo $rep2['libelle'];?>
				</span>
			</small>
		</h3>
	</div>
	<div class="panel-body">
		<?php echo $rep1['contenu'];?>
	</div>
	<div class="panel-footer">
		Autheur : <?php echo $rep3['login'];?><span style="float:right;">Date de Cr&eacute;ation : <?php echo date("d/m/Y H:i:s", strtotime($rep1['dateCreation']));?></span><br>
		Version : <?php echo $rep1['version'];?><span style="float:right;">Nombre de Vue : <?php echo $rep1['vue'];?></span><br/>
		<?php if (isset($_COOKIE['adm'])){ ?>
		<button  type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#faqedit<?php echo $_GET['id'];?>">Changer vos information</button>
		<div class="modal fade bs-example-modal-lg" id="faqedit<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<form method="POST" action="faq.php?id=<?php echo $_GET['id'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $rep1['titre'];?></h4>
      </div>
      <div class="modal-body">
		
			<label>Contenue</label>
				<textarea class="form-control" name="contenu" rows="1"><?php echo $rep1['contenu'];?></textarea>
			
		
				<?php
					$version = ($rep1['version'] + 1);
					if (isset($_POST['contenu'])){
						$update = $db -> prepare('UPDATE faq set contenu = :contenu, version = :version WHERE id = :id');
						$update -> execute(array('contenu' => $_POST['contenu'],'version' => $version, 'id' => $_GET['id'] ));
						header('Refresh: 2 ;url=faq.php?id='.$_GET['id'].'');
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
		<a href="adm_del.php?faq=<?php echo $_GET['id'];?>" type="button" class="btn btn-danger btn-sm" >Supprimer</a>
		
		<?php } ?>
	</div>
</div>
<?php 
pagination();
?>

<?php
vue();
}
include_once 'footer.php';
?>
