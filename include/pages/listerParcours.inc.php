<?php
	$pdo=new Mypdo();
	$parcoursManager = new ParcoursManager($pdo);
	$totParcours=$parcoursManager->getParcours();
  $nbParcours = count($totParcours);
	?>

		<div>
			<h1>Liste des parcours proposés</h1>
      Actuellement, <?php echo $nbParcours ?> parcours sont enregistrés
      <br><br>

			<table>
				<tr><th>Numéro</th><th>Ville de départ</th><th>Ville de destination</th><th>Distance (km)</th></tr>
				<?php
				foreach ($totParcours as $parcours){ ?>
					<tr>
            <td><?php echo $parcours->getParNum();?></td>
						<td><?php echo $parcours->getVilNom1();?></td>
						<td><?php echo $parcours->getVilNom2();?></td>
            <td><?php echo $parcours->getParKm();?></td>
					</tr>
				<?php } ?>
			</table>
			<br />
</div>
