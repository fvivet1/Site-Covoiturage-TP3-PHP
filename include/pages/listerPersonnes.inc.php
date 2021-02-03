<?php
	$pdo=new Mypdo();
	$personneManager = new PersonneManager($pdo);
	$totPersonnes=$personneManager->getPersonnes();
  $nbPersonnes = count($totPersonnes);


  if (empty($_GET["per_num"])) {
		?>
		<div>
			<h1>Liste des personnes enregistrées</h1>
      Actuellement, <?php echo $nbPersonnes ?> personnes sont enregistrés
      <br><br>

			<table>
				<tr><th>Numéro</th><th>Nom</th><th>Prénom</th></tr>
				<form name="formVille" id="formAjVille" method="post">
				<?php
				foreach ($totPersonnes as $personne){ ?>
					<tr>
            <td><a href="index.php?page=2&per_num=<?php echo $personne->getPerNum() ?>"><?php echo $personne->getPerNum() ?></a></td>
						<td><?php echo $personne->getPerNom();?></td>
						<td><?php echo $personne->getPerPrenom();?></td>
					</tr>
				<?php } ?>
			</table>
			<br />
		</div>
		<?php
	} else {
			$per_num = $_GET["per_num"];
	    $detailPers = $personneManager->getPersonneById($per_num);

			if ($personneManager->getCategorieById($per_num) =="etudiant") {

				$etudiantManager= new EtudiantManager($pdo);
				$etudiant = $etudiantManager->getEtudiantById($per_num);
				$departementManager= new DepartementManager($pdo);
				$departement = $departementManager->getDepartementById($etudiant->getDepNum());
				$villeManager = new VilleManager($pdo);
				$ville = $villeManager->getVilleById($departement->getVilNum());
				?>
				<h2>Détail sur l'étudiant <?php echo $detailPers->getPerNom(); ?></h2>
				<table>
					<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>
					<tr>
            <td><?php echo $detailPers->getPerPrenom(); ?></td>
						<td><?php echo $detailPers->getPerMail();?></td>
						<td><?php echo $detailPers->getPerTel(); ?></td>
						<td><?php echo $departement->getDepNom();?></td>
						<td><?php echo $ville->getVilNom();?></td>
					</tr>
				</table> <?php
			}

			if ($personneManager->getCategorieById($per_num) =="salarie") {

				$salarieManager= new SalarieManager($pdo);
				$salarie = $salarieManager->getSalarieById($per_num);
				$fonctionManager= new FonctionManager($pdo);
				$fonction = $fonctionManager->getFonctionById($salarie->getFonNum());
				?>
				<h2>Détail sur le salarié <?php echo $detailPers->getPerNom(); ?></h2>
				<table>
					<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>
					<tr>
            <td><?php echo $detailPers->getPerPrenom(); ?></td>
						<td><?php echo $detailPers->getPerMail();?></td>
						<td><?php echo $detailPers->getPerTel(); ?></td>
						<td><?php echo $salarie->getSalTelProf();?></td>
						<td><?php echo $fonction->getFonLibelle();?></td>
					</tr>
				</table> <?php
			}
		}
?>
