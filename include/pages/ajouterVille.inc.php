
<h1>Ajouter une ville</h1>
<?php
if (empty($_POST["vil_nom"]))
{
  ?>
    <form name="formVille" id="formAjVille" method="post">
      <b>Nom :</b> <input type="text" name="vil_nom">
      <input type="submit" value="Valider">
    </form>

    <?php
    }
    else
    {
      $pdo=new Mypdo();
      $villeManager = new VilleManager($pdo);
      $ville = new Ville($_POST);
      $retour=$villeManager->add($ville);
      echo "<img src="."image/valid.png"."> La ville \"<b>".$ville->getVilNom()."</b>\" a bien été ajoutée";
    }
?>
