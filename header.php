
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HelpDesk - <?php echo $title;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery-1.11.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/dataTables.bootstrap.css">
<link href="./css/bootstrap-theme.min.css" data-href="./css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">
		<script type="text/javascript" language="javascript" src="./js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" language="javascript" src="./js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="./js/dataTables.bootstrap.js"></script>
	
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
    	<div class="container">
        	<div class="navbar-header">
				<button class="navbar-toggle collapsed" data-toggle="collapse" href="#navbar1" aria-expanded="false" aria-controls="navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
				</button>
              
        		<a class="navbar-brand" href="index.php">HelpDesk</a>
            </div>
            <div id="navbar1" class="navbar-collapse collapse">
          		<ul class="nav navbar-nav">
<?php
	if (!isset($_COOKIE['user'])){
		echo '<li><a href="index.php">Accueil</a></li>';
	}else{
			echo '<li><a href="index.php">Accueil</a></li>';
			if (!isset($_COOKIE['adm'])){
        	    	echo '<li><a href="ticket.php">Cr&eacute;er un ticket</a></li>
					<li><a href="tickets.php">Tickets</a></li>
					<li><a href="faq.php">Foire aux questions</a></li>';
			}else{
				echo '
				<li><a href="ticket.php">Cr&eacute;er un ticket</a></li>
				<li><a href="tickets.php">Tickets</a></li>
				<li><a href="faq.php">Foire aux questions</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="adm_tickets.php">Gestion des Tickets</a></li>
						<li><a href="adm_cat.php">Gestion des Cat&eacute;gories</a></li>
						<li><a href="adm_user.php">Gestion des Utilisateurs</a></li>
						<li><a href="adm_faq.php">Gestion de la FAQ</a></li>
						<li><a href="adm_statut.php">Gestion des Statuts</a></li>
						<li class="divider"></li>
						<li><a href="#">Information</a></li>
					</ul>
				</li>
				
				';
	}
	}
?>                    
       			</ul>
        		<ul class="nav navbar-nav navbar-right">
<?php

	if (!isset($_COOKIE['user'])){
		echo '  <li><a href="login.php">Connexion</a></li>
          		<li><a href="register.php">Inscription</a></li>';
	}else{
		$username = $_COOKIE['user'];
		$iduser = $_COOKIE['id'];
		echo '<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$username.' <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="profils.php?id='.$iduser.'">Votre Proflis</a></li>
						<li class="divider"></li>
						<li><a href="logout.php">Deconnexion</a></li>
					</ul>
				</li>';
	}
					
?>					
	          </ul>
    	    </div>
		</div>
    </nav>
	

	<div class="bs-docs-header">
		<div class="container">
			<div class="header">
				

				<h1>HelpDesk</h1>
				<p>Assistance, Support et Gestion de ticket</p>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="second-header"></div>
    <div class="container">
	<?php
	include_once './include/function/header.php';
		User_verif();
		?>      	