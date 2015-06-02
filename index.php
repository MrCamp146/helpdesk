<?php
$title = "Accueil";
include 'header.php';
?>
<ol class="breadcrumb">
  <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>

 </ol>
<?php

	if (!isset($_COOKIE['user'])){ //si l'utilisateur n'est pas connecter => statistique
	?>
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Statistique</h3>
	</div>
	
	<div class="panel-body">
		<?php
			include_once './include/function/index.php';
			Stats_visiteur();
		?>
		
</div>
</div>

<?php
}else{ //si l'utilisateur est connecter => info ticket et faq

?>

<div class="panel panel-primary">
<div class="panel-heading">
		<h3>Mes Tickets</h3>
	</div>
	<div class="panel-body">
		<table class="table">
		<?php 
			include_once "./include/function/index.php";
			Stats_user();
		?>
			
		</table>
	</div>
	<div class="panel-footer">
		<a href="ticket.php" type="button" class="btn btn-sm btn-primary">Cr&eacute;er un ticket</a>
	</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Base de connaissance : Sujet les plus r&eacute;cents </h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
		<thead>
			<tr><th>Titre <span style="float:right;">Date</span></th></td>
		</thead>
		<tbody>
			<?php
				include_once "./include/function/index.php";
				faq_accueil();
			?>
			</tbody>
			</table>
	</div>
</div>
<?php 
}
include 'footer.php';
?>