<?php session_start();
date_default_timezone_set('Europe/Paris');?>
<!doctype html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <!-- Trouver comment ne pas mettre le css en cache <meta http-equiv="pragma" content="no-cache" > -->
<?php
		$title = "Bienvenue sur le site de covoiturage de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>
	<body>
	<div id="header">
		<div id="entete">
			<div class="colonne">
				<a href="index.php?page=0">
					<img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" />
				</a>
			</div>
			<div class="colonne">
				Covoiturage de l'IUT,<br />Partagez plus que votre véhicule !!!
			</div>
			</div>
			<div id="connect">
        <?php //gestion de l'encadré connexion/connecté
        if (empty($_SESSION["user"])){
  				echo "<a href=\"index.php?page=11\">Connexion</a>";

        } else {
          $user = $_SESSION["user"];
          echo "Utilisateur :<b>$user</b> <a href=\"index.php?page=12\"> - Déconnexion</a>";
        }?>
			</div>
	</div>
