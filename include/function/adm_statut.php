<?php
include_once './include/database.php';
function liste_statut(){		
	$db = BDD();
	$req_list = $db -> prepare('SELECT * FROM statut ORDER BY ordre'); //recuperation de la base de donnée trier par l'id de l'utilisateur
	$req_list -> execute(array());
	while ($reponse_liste = $req_list->fetch()){ // on recupère tout
?>
	<tr> 
		<td><?php echo $reponse_liste['ordre'];?></td>
		<td><?php echo $reponse_liste['libelle'];?> <span class="glyphicon glyphicon-<?php echo $reponse_liste['icon'];?>"></span> <span style="float:right;"><a  type="button" class="btn btn-danger btn-sm" href="adm_del.php?statuts=<?php echo $reponse_liste['id'];?>">Supprimer</a></span></td>
	</tr>
<?php
	}
}

?>
