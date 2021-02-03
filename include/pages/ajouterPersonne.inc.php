<?php
$pdo=new Mypdo();


if (empty($_POST["per_nom"]) || empty($_POST["per_tel"]) || empty($_POST["per_login"]) || empty($_POST["per_prenom"]) || empty($_POST["per_mail"]) || empty($_POST["per_pwd"]) || empty($_POST["per_cat"]))
{

		?>
		<h1>Ajouter une personne</h1>
		<?php
		if (!empty($_POST["div_num"]) && !empty($_POST["dep_num"]))
		{
			  $personneManager = new PersonneManager($pdo);
			  $personne = unserialize($_SESSION["personne"]);
			  $num_etu_added=$personneManager->add($personne);

				$etudiantManager = new EtudiantManager($pdo);
				$etudiant = new Etudiant($_POST);
				$retour=$etudiantManager->add($etudiant, $num_etu_added);

				echo "<img src="."image/valid.png"."> L'étudiant \"<b>".$personne->getPerPrenom()." ".$personne->getPerNom()."</b>\" a bien été ajoutée";
		}
		else
		{
			  if (!empty($_POST["fon_num"]))
				{
					  $personneManager = new PersonneManager($pdo);
					  $personne = unserialize($_SESSION["personne"]);
					  $num_sal_added=$personneManager->add($personne);

						$salarieManager = new SalarieManager($pdo);
						$salarie = new Salarie($_POST);
						$retour=$salarieManager->add($salarie, $num_sal_added);

						echo "<img src="."image/valid.png"."> Le salarié \"<b>".$personne->getPerPrenom()." ".$personne->getPerNom()."</b>\" a bien été ajoutée";
				}
				else
				{

					  ?>

						<form name="formPers" id="formAjPers" method="post">
							<div id='saisieForm'>
								<div class="formCol">
									<b>Nom : </b> </br>
									<b>Téléphone : </b> </br>
									<b>Login : </b> </br>
								</div>
								<div class="formCol">
									<input type="text" name="per_nom" tabindex="1"> <br>
									<input type="tel" name="per_tel" tabindex="3" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"> <br>
									<input type="text" name="per_login" tabindex="5"> <br>
								</div>
								<div class="formCol">
									<b>Prénom : </b> </br>
									<b>Mail : </b> </br>
									<b>Mot de passe : </b> </br>
								</div>
								<div class="formCol">
									<input type="text" name="per_prenom" tabindex="2"> </br>
									<input type="email" name="per_mail" tabindex="4"> </br>
									<input type="password" name="per_pwd" tabindex="6"> </br>
								</div>
							</div>
							<div>
							<b>Catégorie : </b>
								<input type="radio" id="choix1" name="per_cat" value="etudiant">
						    <label for="choix1">Etudiant</label>

								<input type="radio" id="choix2" name="per_cat" value="personnel">
					      <label for="choix2">Personnel</label>
							</div>
							<br/>

							<input type="submit" value="Valider">
						</form>
				  	<?php
				}
			}
}
if (!empty($_POST["per_nom"]) && !empty($_POST["per_prenom"]) && !empty($_POST["per_tel"]) && !empty($_POST["per_mail"]) && !empty($_POST["per_login"]) && !empty($_POST["per_pwd"])) {
	if (!empty($_POST["per_cat"])){
		$personne = new Personne($_POST);
		$_SESSION["personne"] = serialize($personne);
	if ($_POST["per_cat"] == "etudiant")
	{
			if (empty($_POST["div_num"]) || empty($_POST["dep_num"]))
			{

				$divisionManager = new DivisionManager($pdo);
				$divisions=$divisionManager->getDivisions();
				$departementManager = new DepartementManager($pdo);
				$departements=$departementManager->getDepartements();
				?>
				<h1>Ajouter un étudiant</h1>
				<form name="formAjEtudiant" id="formAjEtudiant" method="post">
					Année 1 : <select name="div_num" required>
											<option value="">---</option>
											<?php
											foreach ($divisions as $division){
												echo "<option value=\"".$division->getDivNum()."\">".$division->getDivNum()."</option>";
											}
										?>
										</select>
										<br/><br/>
					Département : <select name="dep_num" required>
													<option value="">---</option>
													<?php
													foreach ($departements as $departement){
														echo "<option value=\"".$departement->getDepNum()."\">".$departement->getDepNom()."</option>";
													}
													?>
												</select>
												<br/><br/>
					<input type="submit" value="Valider">
				</form>

				<?php
			}
	}
	if ($_POST["per_cat"] == "personnel")
	{
		if (empty($_POST["fonction"]))
			{

				$fonctionManager = new FonctionManager($pdo);
				$fonctions=$fonctionManager->getFonctions();
				?>
				<h1>Ajouter un salarié</h1>
		    <form name="formAjSalarie" id="formAjSalarie" method="post">
					Téléphone professionnel : <input type="text" name="sal_telprof"> <br/><br/>
					Fonction : <select name="fon_num">
		                  <option value="">---</option>
		                  <?php
		                  foreach ($fonctions as $fonction){
		                    echo "<option value=\"".$fonction->getFonNum()."\">".$fonction->getFonLibelle()."</option>";
		                  }
		                  ?>
		                </select>
		      <input type="submit" value="Valider">
		    </form>

				<?php
			}
		}
	}
}
