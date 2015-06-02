<?php
$title = "Inscription";
include "header.php";
include_once "include/fonction.php";
Register();    
?>

<div class="panel panel-default" style="width:75%; margin:auto;">
		<div class="panel-heading">
        	<h2 class="form-signin-heading">Inscription</h2>
        </div>
        <div class="panel-body">

		<form class="form-signin" role="form" action="register.php" method="post">
        	<div class="col-md-6">
				<input type="text" name = "login" class="form-control" placeholder="Login" required><br/>
	            <input type="email" name = "email" class="form-control" placeholder="Adresse email" required> <br/>
            </div>
             <div class="col-md-6">
            	<input type="password" name="password" class="form-control" placeholder="Mot de passe" required><br />
            	<input type="password" name="confirm" class="form-control" placeholder="Confirmation de mot de passe" required><br/>
           </div><hr />
            	<button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>      
        
      </form>
      
      </div>
</div>
<?php
include "footer.php";
?>