<?php
$title = "Gestion de la FAQ";
include 'header.php';
$_GET['faq']; // pages pour les detail d'un ticket et les messages.
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
		<h3>Gestion de la FAQ</h3>
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
            	<th>Categorie</th>
				<th>Version</th>
                <th>Date</th>
                
            </tr>
            </thead>
            <tbody>
				<?php
					
					$db = BDD();
					$req_list = $db -> prepare('SELECT * FROM faq'); //recuperation de la base de donnée trier par l'id de l'utilisateur
					$req_list -> execute(array());
					while ($reponse_liste = $req_list->fetch()){ // on recupère tout
						$idfaq = $reponse_liste['id'];
						$titre = $reponse_liste['titre'];
						$version = $reponse_liste['version'];
						$date = $reponse_liste['dateCreation'];
						$req_categorie = $db -> prepare('SELECT * FROM categorie WHERE id = :id');
							$req_categorie -> execute(array('id' => $reponse_liste['idCategorie']));
							while ($reponse_categorie = $req_categorie->fetch()){
								$categorie_lib = $reponse_categorie['libelle'];
						
								// on affiche les information
							
?>
			<tr> 
				<td><a href="faq.php?id=<?php echo $idfaq;?>"><?php echo $titre;?></a></td>
				<td><?php echo $categorie_lib;?></td>
				<td><?php echo $version;?></td>
				<td><?php echo $date;?></td>
				

			</tr>
<?php							

				}}
				?>
			</tbody>
		  </table>
	</div>
	<div class="panel-footer">
		<button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addfaq">Ajouter FAQ</button>
		<div class="modal fade bs-example-modal-lg" id="addfaq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
	<form method="POST" action="adm_faq.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter une Question </h4>
      </div>
      <div class="modal-body">
		<label>Categorie</label>
		<select name="categorie" class="form-control">
			
			<?php
				$db = BDD();
					$req = $db -> prepare('SELECT id, libelle FROM  categorie');
					$req -> execute();
					while ($rep = $req->fetch()){
						echo '<option value="'.$rep['id'].'">'.$rep['libelle'].'</option>';
					}
				?>
		</select>
		<label>Titre</label>
			<input class="form-control" name="titre">
        <label>Contenue</label>
			<textarea class="ckeditor" row="2" name="contenu"></textarea>
		 <label>Utilisateur</label>
			<input type="text" class="form-control" name="login" placeholder="<?php echo $_COOKIE['user'];?>" disabled>
		<label>Date de creation</label>
			<input type="text" class="form-control" name="date" placeholder="<?php echo date("d-m-Y");?>" disabled>
		<label>Version</label>
			<input type="text" class="form-control" name="date" placeholder="1.0" disabled>			
				<?php
					if (isset($_POST['titre']) and isset($_POST['contenu']) and isset($_POST['categorie'])){
						$addmessage = $db -> prepare('INSERT INTO faq (titre, contenu, idUser, idCategorie) VALUES (:titre, :contenu, :idUser, :idCategorie)');
						$addmessage -> execute(array('titre' => $_POST['titre'], 'contenu' => $_POST['contenu'], 'idUser' => $_COOKIE['id'], 'idCategorie' => $_POST['categorie'] ));
						header('Refresh: 2 ;url=adm_faq.php');
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
<?php
}

?>
<?php
include 'footer.php';
?>