<?php
	$pdo=new Mypdo();
	$villeManager = new VilleManager($pdo);
	$villes=$villeManager->getVilles();
?>

<h1>Ajouter un parcours</h1>
<?php
if (empty($_POST["vil_nom1"]) || empty($_POST["vil_nom2"]) || empty($_POST["par_km"]))
{
  ?>
    <form name="formParc" id="formAjParcours" method="post">
      <b>Ville 1 :</b> <select name="vil_nom1">
                  <option value="">---</option>
                  <?php
                  foreach ($villes as $ville){
                    echo "<option value=\"".$ville->getVilNom()."\">".$ville->getVilNom()."</option>";
                  }
                  ?>
                </select>
      <b>Ville 2 :</b> <select name="vil_nom2">
                  <option value="">---</option>
                    <?php
                    foreach ($villes as $ville){
                      echo "<option value=\"".$ville->getVilNom()."\">".$ville->getVilNom()."</option>";
                    }
                    ?>
                </select>
      <input type="number" name="par_km" min="0">
      <input type="submit" value="Valider">
    </form>

    <?php
    }
    else
    {
      $pdo=new Mypdo();
      $parcoursManager = new ParcoursManager($pdo);
      $parcours = new Parcours($_POST, $pdo);
      $retour=$parcoursManager->add($parcours);
      echo "<img src="."image/valid.png"."> Le parcours \"<b>".$parcours->getVilNom1()."</b> - <b>".$parcours->getVilNom2()."</b>\" a bien été ajouté";
			echo " test".$parcours->getParNum();
    }
?>
