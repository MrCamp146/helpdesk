<?php
$title = "Gestion des Cat&eacute;gories";
include 'header.php';


include_once './include/database.php';
include_once './include/function/adm_cat.php';
$db = BDD();
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
		<h3><?php echo $title;?></h3>
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
				<th>Titre</th>
				
               
                
            </tr>
            </thead>
            <tbody>
			<?php
					
					liste_cat();
				?>
			</tbody>
		  </table>
	</div>
	<div class="panel-footer">
		<button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcat">Ajouter une Cat&eacute;gorie</button>
		
		<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="POST" action="adm_cat.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter une Cat&eacute;gorie</h4>
      </div>
      <div class="modal-body">
	  
        <label>Titre Categorie</label>
			<input class="form-control" name="cat">
		<label>Categorie Parents</label>
			<select class="form-control" name="parent">
				<option value="">Aucun</option>
				<?php
					liste_cat_parent();
				
				?>
			</select>
		<?php
				addcat();
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
<?php
}
include 'footer.php';
?>