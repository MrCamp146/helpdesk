<?php
$title = "Gestion des tickets";
include 'header.php';
$_GET['edit'];
$_GET['ticket']; // pages pour les detail d'un ticket et les messages.
include_once './include/database.php';
if (!isset($_COOKIE['adm'])){ //on verifie que l'utilisateur est connecter.
		//si non
		echo "<div class='alert alert-info'>Vous n'êtes pas Administrateur, vous ne pouvez donc accéder a cette pagges.</div>";
		header('Refresh: 2, url=index.php'); // on le renvois sur la pages d'accueil.
	}else{
?>
<ol class="breadcrumb">
  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Accueil</a></li>
  <li class="active"><?php echo $title;?></li>
 </ol>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Gestion des tickets</h3>
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
				<th>Autheur</th>
                <th>Categorie</th>
                <th>Status</th>
                <th>date</th>
            </tr>
            </thead>
            <tbody>
				<?php
					include_once './include/function/adm_tickets.php';
                    liste_adm_ticket();
				?>
			</tbody>
		  </table>
	</div>
</div>
<?php
}


?>
<?php
include 'footer.php';
?>