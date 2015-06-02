<?php 
include_once '../database.php';

function sujet_faq(){
				$db = BDD();
				$req_tri_cat = $db -> prepare('SELECT * FROM categorie');
				$req_tri_cat -> execute();
				while ($reponse_tri_cat = $req_tri_cat->fetch()){
					if (empty($reponse_tri_cat['idCategorie'])){
							echo '<thead><tr><th>'.$reponse_tri_cat['libelle'].'</th></td></thead>';
						}else{
							$req_pa = $db -> prepare('SELECT libelle FROM  categorie WHERE id = :idCategorie');
							$req_pa -> execute(array('idCategorie' => $reponse_tri_cat['idCategorie']));
							$reponse = $req_pa->fetch();
							echo '<thead><tr><th>'.$reponse_tri_cat['libelle'].' ('.$reponse['libelle'].')</th></td></thead>';
						}

					$req = $db -> prepare('SELECT * FROM faq WHERE idCategorie = '.$reponse_tri_cat['id'].'');
					$req -> execute();
					while ($rep = $req->fetch()){
						$dates = date("d/m/Y H:i:s", strtotime($rep['dateCreation']));
					echo '
					<tr><td><a href="faq.php?id='.$rep['id'].'">'.$rep['titre'].'</a><span style="float: right;"><?php echo $dates;?></span></th></td>';

				}
			}
		}
		
function faq_pop(){
					$db = BDD();
				$req_pop = $db -> prepare('SELECT * FROM faq ORDER BY vue desc LIMIT 0,10');
				$req_pop -> execute();
				while ($reponse_pop = $req_pop -> fetch()){
					
					echo '<tr>
							<td><a href="faq.php?id='.$reponse_pop['id'].'">'.$reponse_pop['titre'].'</a><span style="float:right;">'.$reponse_pop['vue'].'</span></td>
						</tr>';
				}
			}

function new_faq(){
				$db = BDD();
				$req_new = $db -> prepare('SELECT * FROM faq ORDER BY dateCreation desc LIMIT 0,10');
				$req_new -> execute();
				while ($reponse_new = $req_new -> fetch()){
					$dates = date("d/m/Y H:i:s", strtotime($reponse_new['dateCreation']));
					echo '<tr>
							<td><a href="faq.php?id='.$reponse_new['id'].'">'.$reponse_new['titre'].'</a><span style="float:right;">'.$dates.'</span></td>
						</tr>';
				}
			}

function faq_id(){
if (isset($_GET['id'])){
	$db = BDD();
	$req1 = $db ->prepare('SELECT * FROM faq WHERE id = :id');
	$req1 -> execute(array('id' => $_GET['id']));
	$rep1 = $req1->fetch();
	$req2 = $db -> prepare('SELECT libelle FROM categorie WHERE id = :id');
	$req2 -> execute(array('id' => $rep1['idCategorie']));
	$rep2 = $req2->fetch();
	$req3 = $db -> prepare('SELECT login FROM user WHERE id = :id');
	$req3 -> execute(array('id' => $rep1['idUser']));
	$rep3 = $req3->fetch();
	}
}
function update_faq(){
					$version = ($rep1['version'] + 1);
					if (isset($_POST['contenu'])){
						$update = $db -> prepare('UPDATE faq set contenu = :contenu, version = :version WHERE id = :id');
						$update -> execute(array('contenu' => $_POST['contenu'],'version' => $version, 'id' => $_GET['id'] ));
						header('Refresh: 2 ;url=faq.php?id='.$_GET['id'].'');
					}
				}
				
function pagination(){
if (isset($_GET['id'])){
	$db = BDD();
	$req_precedent = $db ->prepare('SELECT MIN(id) as min FROM faq');
	$req_precedent -> execute();
	$rep_precedent = $req_precedent->fetch();
	$req_next = $db ->prepare('SELECT MAX(id) as Max FROM faq ');
	$req_next -> execute();
	$rep_next = $req_next->fetch();
	if ($rep_precedent['min'] == $_GET['id']){
		$previous = $_GET['id'];
		$disabled = "disabled";
	}else{
		$previous = ($_GET['id'] - 1);
		$disabled = "";
	}
	if ($rep_next['Max'] == $_GET['id']){
		$next = $_GET['id'];
		$disabled_next = "disabled";
	}else{
		$next = ($_GET['id'] + 1);
		$disabled_next = "";
	}
	echo '<nav>
  <ul class="pager">
    <li class="previous '.$disabled.'"><a href="faq.php?id='.$previous.'"><span aria-hidden="true">&larr;</span> Pr&eacute;c&eacute;dent</a></li>
    <li class="next  <?php '.$disabled_next.'"><a href="faq.php?id='.$next.'">Suivant <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>';
	}
}

function vue(){
	if (isset($_GET['id'])){
		$db = BDD();
		$req_nbr_vue = $db -> prepare('SELECT vue FROM faq WHERE id = :id');
		$req_nbr_vue -> execute(array('id' => $_GET['id']));
		$rep1 = $req_nbr_vue->fetch();
		$upvue = ($rep1['vue'] + 1);
		$req_vue = $db -> prepare('UPDATE faq SET vue = :vue WHERE id = :id');
		$req_vue -> execute(array('vue' => $upvue  ,'id' => $_GET['id']));
	}
}
