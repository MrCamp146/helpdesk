<?php
$title = "Connexion";
include "header.php";
include_once "include/fonction.php";
Connection();
?>
<div class="panel panel-default" style="width:50%; margin:auto;">
	<div class="panel-heading">            <h2 class="form-signin-heading">Connexion sur le site</h2>	 </div>
    <div class="panel-body">
 <form class="form-signin" role="form" form action="login.php" method="POST">
            <input type="text" name="login" class="form-control" placeholder="Login" required><br/>
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required><br/>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
	    </form>
        </div></div>

<?php
include "footer.php";
?>