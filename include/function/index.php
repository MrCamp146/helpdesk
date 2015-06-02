<?php
function Stats_visiteur(){
			include_once './include/database.php';
			$db = BDD();
			$req_count_ticket = $db -> prepare('SELECT count(*) as allticket FROM ticket');
			$req_count_ticket -> execute();
			$rep_count_ticket = $req_count_ticket->fetch();
			if ($rep_count_ticket['allticket'] < 1){
				$ticket_all = 0;
			}else{
				$ticket_all = $rep_count_ticket['allticket'];
			}
			
			$req_count_new = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 1');
			$req_count_new -> execute();
			$rep_count_new = $req_count_new->fetch();
			if ($rep_count_new['allticket'] < 1){
				$ticket_new = 0;
				$ticket_new_pourcent = 0;
			}else{
				$ticket_new = $rep_count_new['allticket'];
				$ticket_new_pourcent = ($ticket_new / $ticket_all)*100;
			}
			$req_count_attri = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 2');
			$req_count_attri -> execute();
			$rep_count_attri = $req_count_attri->fetch();
			if ($rep_count_attri['allticket'] < 1){
				$ticket_attri = 0;
				$ticket_attri_pourcent = 0;
			}else{
				$ticket_attri = $rep_count_attri['allticket'];
				$ticket_attri_pourcent = ($ticket_attri / $ticket_all)*100;
			}
			$req_count_atten = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 3');
			$req_count_atten -> execute();
			$rep_count_atten = $req_count_atten->fetch();
			if ($rep_count_atten['allticket'] < 1){
				$ticket_atten = 0;
				$ticket_atten_pourcent = 0;
			}else{
				$ticket_atten = $rep_count_atten['allticket'];
				$ticket_atten_pourcent = ($ticket_atten / $ticket_all)*100;
			}					
			$req_count_reso = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 4');
			$req_count_reso -> execute();
			$rep_count_reso = $req_count_reso ->fetch();
			if ($rep_count_reso['allticket'] < 1){
				$ticket_reso = 0;
				$ticket_reso_pourcent = 0;
			}else{
				$ticket_reso = $rep_count_reso['allticket'];
				$ticket_reso_pourcent = ($ticket_reso / $ticket_all)*100;
			}
			$req_count_clos = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 5');
			$req_count_clos -> execute();
			$rep_count_clos = $req_count_clos ->fetch();
			if ($rep_count_clos['allticket'] < 1){
				$ticket_clos = 0;
				$ticket_clos_pourcent = 0;
			}else{
				$ticket_clos = $rep_count_clos['allticket'];
				$ticket_clos_pourcent = ($ticket_clos / $ticket_all)*100;
			}
			
			
			
			
			
			?>
	<p>Nombre de ticket : <?php echo $ticket_all;?></p>
	<div class="col-md-6">
		<p>Nouveau ticket : <?php echo $ticket_new;?></p>
		<div class="progress">
			<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $ticket_new_pourcent;?>" aria-valuemin="0" aria-valuemax="100" style="min-width: <?php echo $ticket_new_pourcent;?>%;">
				<?php echo (int) ($ticket_new_pourcent);?>%
			</div>
		</div>
		<p>Attribuer : <?php echo $ticket_attri;?></p>
		<div class="progress">
			<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $ticket_attri_pourcent;?>" aria-valuemin="0" aria-valuemax="100" style="min-width: <?php echo $ticket_attri_pourcent;?>%;">
				<?php echo (int) ($ticket_attri_pourcent);?>%
			</div>
		</div>
		<p>En attente : <?php echo $ticket_atten;?></p>
		<div class="progress">
			<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $ticket_atten_pourcent;?>" aria-valuemin="0" aria-valuemax="100" style="min-width: <?php echo $ticket_atten_pourcent;?>%;">
				<?php echo (int) ($ticket_atten_pourcent);?>%
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<p>Resolue : <?php echo $ticket_reso;?></p>
		
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $ticket_reso_pourcent;?>" aria-valuemin="0" aria-valuemax="100" style="min-width: <?php echo $ticket_reso_pourcent;?>%;">
				<?php echo (int) ($ticket_reso_pourcent);?>%
			</div>
		</div>
		<p>Clos : <?php echo $ticket_clos;?></p>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $ticket_clos_pourcent;?>" aria-valuemin="0" aria-valuemax="100" style="min-width: <?php echo $ticket_clos_pourcent;?>%;">
				<?php echo (int) ($ticket_clos_pourcent);?>%
			</div>
		</div>
	</div>
<?php
			}
			
function Stats_user(){
		
			include_once "./include/database.php";
			$db = BDD();
			$req_count_new = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 1 AND idUser = :idUser');
			$req_count_new -> execute(array('idUser' => $_COOKIE['id']));
			$rep_count_new = $req_count_new->fetch();
			if ($rep_count_new['allticket'] < 1){
				$ticket_new = 0;
			}else{
				$ticket_new = $rep_count_new['allticket'];
			}
			$req_count_attri = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 2 AND idUser = :idUser');
			$req_count_attri -> execute(array('idUser' => $_COOKIE['id']));
			$rep_count_attri = $req_count_attri->fetch();
			if ($rep_count_attri['allticket'] < 1){
				$ticket_attri = 0;
			}else{
				$ticket_attri = $rep_count_attri['allticket'];
			}
			$req_count_atten = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 3 AND idUser = :idUser');
			$req_count_atten -> execute(array('idUser' => $_COOKIE['id']));
			$rep_count_atten = $req_count_atten->fetch();
			if ($rep_count_atten['allticket'] < 1){
				$ticket_atten = 0;
			}else{
				$ticket_atten = $rep_count_atten['allticket'];
			}
			$req_count_reso = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 4 AND idUser = :idUser');
			$req_count_reso -> execute(array('idUser' => $_COOKIE['id']));
			$rep_count_reso = $req_count_reso ->fetch();
			if ($rep_count_reso['allticket'] < 1){
				$ticket_reso = 0;
			}else{
				$ticket_reso = $rep_count_reso['allticket'];
			}
			$req_count_clo = $db -> prepare('SELECT count(*) as allticket FROM ticket WHERE idStatut = 5 AND idUser = :idUser');
			$req_count_clo -> execute(array('idUser' => $_COOKIE['id']));
			$rep_count_clo = $req_count_clo ->fetch();
			if ($rep_count_clo['allticket'] < 1){
				$ticket_clo = 0;
			}else{
				$ticket_clo = $rep_count_clo['allticket'];
			}
			?>
			<tr class="danger"><td>Nouveau <span class="glyphicon glyphicon-flag"></span> <span style="float:right;"><?php echo $ticket_new;?></td></tr>
			<tr class="warning"><td>Attribuer <span class="glyphicon glyphicon-user"></span> <span style="float:right;"><?php echo $ticket_attri;?></td></tr>
			<tr class="active"><td>En attente <span class="glyphicon glyphicon-hourglass"></span> <span style="float:right;"><?php echo $ticket_atten;?></td></tr>
			<tr class="info"><td>R&eacute;solu <span class="glyphicon glyphicon-check"></span> <span style="float:right;"><?php echo $ticket_reso ;?></td></tr>
			<tr class="success"><td>Clos <span class="glyphicon glyphicon-off"></span> <span style="float:right;"><?php echo $ticket_clo;?></td></tr>
			<?php
		}
function faq_accueil(){
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
			?>
		