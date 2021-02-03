<?php
	$pdo=new Mypdo();
	$villeManager = new VilleManager($pdo);
	$villes=$villeManager->getVilles();
	$nbVilles = count($villes);
	?>

		<div>
			<h1>Liste des villes</h1>
			Actuellement <?php echo $nbVilles ?> villes sont enregistrées
			<table>
				<tr><th>Numéro</th><th>Nom</th></tr>
				<?php
				foreach ($villes as $ville){ ?>
					<tr>
						<td><?php echo $ville->getVilNum();?></td>
						<td><?php echo $ville->getVilNom();?></td>
					</tr>
				<?php } ?>
			</table>
			<br />
</div>
