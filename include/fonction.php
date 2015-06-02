<?php
include_once 'database.php';
include_once 'config.php';
function Register() {
	
	if (isset($_POST['login']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirm']) and isset($_SERVER['REMOTE_ADDR'])) {

		//après confirmation des champ, connexion à la base de donnée.	
		$db = BDD();
		$ipcli = $_SERVER['REMOTE_ADDR'];
		$login = $_POST['login'];
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$confirm = sha1($_POST['confirm']);
		
		
 
 
		$req_verfi_user = $db->prepare('SELECT count(login) as login FROM user WHERE login = :login');
		$req_verfi_user -> execute(array('login' => $login));
		while ($rep_verif_user = $req_verfi_user -> fetch()){
			$req_verfi_user ->closeCursor();
			if ($rep_verif_user['login'] != 0){
				echo "<div class='alert alert-info'>Ce login existe deja.</div>";
			}else{
				$req_email = $db->prepare('SELECT count(mail) as email FROM user WHERE mail = :mail');
				$req_email->execute(array('mail' => $email));
				while ($rep_email = $req_email->fetch()){
					if ($rep_email['email'] != 0) {
						echo "<div class='alert alert-info'>Ce mail existe d&eacute;j&agrave;.</div>";
					}else{
						if ($password === $confirm) {
							$req = $db->prepare('INSERT INTO user(login, password, mail, ip) VALUES (:login , :password , :mail, :ip)');
							$req ->execute(array('login' => $login, 'password' => $password, 'mail' => $email, 'ip' => $ipcli));


							echo "<div class='alert alert-info'> Votre compte &agrave; bien &eacute;t&eacute; cr&eacute;&eacute;. Bienvenue !
								Vous pouvez d&egrave;s maintenant vous connecter.</div>"; 

							$req ->closeCursor();
						}else{
								echo "<div class='alert alert-info'>Vos mots de passe ne corresponde pas.</div>";
						}
					}
				}
			}
		}
	}
}
function Connection() {
	if (isset($_POST['login']) and isset($_POST['password']))	{
		$login = $_POST['login'];
		$password = sha1($_POST['password']);
		//echo $login;
		//echo $password;
		
		$db = BDD();
	$req_verifuser = $db->prepare('SELECT id, password, login, admin FROM user WHERE login = :login');
        $req_verifuser->execute(array('login' => $login));
	$reponse = $req_verifuser->fetch();
           if ($reponse['login'] == $login){
			   if ($reponse['password'] === $password){
				if ($reponse['admin'] == 1){
				   session_start();
				   $id_user = $reponse['id'];
				   $_SESSION['login'] = $login;
				   $TTL = 3600 * 24;
				   setcookie("id", $id_user, time() + $TTL);
				   setcookie("adm", $_SESSION['login'], time() + $TTL);
				   setcookie("user", $_SESSION['login'], time() + $TTL);
				   header('Location: index.php');
				   $req_verifuser ->closeCursor();
				   }else{
					session_start();
				   $id_user = $reponse['id'];
				   $_SESSION['login'] = $login;
				   $TTL = 3600 * 24;
				   setcookie("id", $id_user, time() + $TTL);
				   setcookie("user", $_SESSION['login'], time() + $TTL);
				   header('Location: index.php');
				   $req_verifuser ->closeCursor();
				   }
			   }else{
				   echo "<div class='alert alert-warning'>Le mot de passe que vous avez saisi est incorrect, 
                            veuillez saisir le bon mot de passe.</div><br/>";
			   }
		   }else{
			   echo "<div class='alert alert-warning'>Le login que vous avez saisi est incorrect, 
                            veuillez saisir le bon login.</div><br/>";
		   }

	}
}
?>