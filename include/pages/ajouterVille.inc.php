
<h1>Ajouter une ville</h1>
<?php
if (empty($_POST["vil_nom"]))
{
  ?>
    <form name="formulaire" id="formAjVille" method="post">
      Nom : <input type="text" name="vil_nom">
      <input type="submit" value="OK">
    </form>

    <?php
    }
    if (!empty($_POST["vil_nom"]))
    {
      $nom=$_POST["vil_nom"];
      $r = "INSERT INTO ville (vil_nom) VALUES ($nom)"
      $result = mysqli_query($db, $result)
      echo "<img src="."image/valid.png"."> La ville \"<b>$nom</b>\" a bien été ajoutée";

    }
?>
