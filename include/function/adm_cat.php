<?php
include_once './include/database.php';
function liste_cat(){
	$db = BDD();
	$req_list = $db -> prepare('SELECT * FROM categorie'); //recuperation de la base de donnée trier par l'id de l'utilisateur
	$req_list -> execute(array());
	while ($reponse_liste = $req_list->fetch()){ // on recupère tout
		if (empty($reponse_liste['idCategorie'])){
			$libelle = $reponse_liste['libelle'];
		}else{
			$req_pa = $db -> prepare('SELECT libelle FROM  categorie WHERE id = :idCategorie');
			$req_pa -> execute(array('idCategorie' => $reponse_liste['idCategorie']));
			$reponse = $req_pa->fetch();
			$libelle = $reponse_liste['libelle'].' ('.$reponse['libelle'].')';
		}

?>
			<tr> 
				<td><?php echo $libelle;?><span style="float:right;"><a  type="button" class="btn btn-danger btn-sm" href="adm_del.php?cat=<?php echo $reponse_liste['id'];?>">Supprimer</a></span></td>
			</tr>
<?php
	}
}
function liste_cat_parent(){
	$db = BDD();
	$req_parent = $db -> prepare('SELECT * FROM categorie WHERE idCategorie is NULL');
	$req_parent -> execute();
	while ($reponse = $req_parent->fetch()){
		echo '<option value="'.$reponse['id'].'">'.$reponse['libelle'].'</option>';
	}
}
function addcat(){
	if (isset($_POST['cat'])) {
		if (isset($_POST['parent'])){
			if (empty($_POST['parent'])){
				include_once './include/database.php';
				$db = BDD();
				$newcat = $db -> prepare('INSERT INTO categorie(libelle) VALUES (:libelle)');
				$newcat -> execute(array('libelle' => $_POST['cat']));
			}else{
				include_once './include/database.php';
				$db = BDD();
				$newcat = $db -> prepare('INSERT INTO categorie(libelle, idCategorie) VALUES (:libelle, :idCategorie)');
				$newcat -> execute(array('libelle' => $_POST['cat'], 'idCategorie' => $_POST['parent']));
			}
		}
	}
}
?>