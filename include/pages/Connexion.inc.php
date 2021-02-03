<?php
if(empty($_SESSION["user"])){
  if ((empty($_POST["login"])) || (empty($_POST["passwd"])) || (empty($_POST["verif"]))){

    $_SESSION["val1"] = rand(1, 9);
    $_SESSION["val2"] = rand(1, 9);
    $_SESSION["resultat"] = ($_SESSION["val1"] + $_SESSION["val2"]);
?>

  <h1>Pour vous connecter</h1>

  <form name="FormConnect" method="post">
    <b>Nom d'utilisateur :</b> <br>
    <input type="text" name="login"> <br>
    <b>Mot de passe :</b> <br>
    <input type="password" name="passwd">
    <h1><img src="image/nb/<?php echo $_SESSION["val1"] ?>.jpg"> + <img src="image/nb/<?php echo $_SESSION["val2"] ?>.jpg"> = </h1>
    <input type="number" name="verif"> <br> <br>
    <input type="submit" value="Valider">

    <?php
  } else {
      $pdo = new Mypdo();
      $personneManager = new PersonneManager($pdo);

      if ($_POST["verif"] == $_SESSION["resultat"]) { //verif catpcha

        if ($personneManager->existe($_POST["login"])) { //verif login existant

          $pwd = $personneManager->getPasswdByLogin($_POST["login"]);
          $typedPwd =$personneManager->encryptPasswd($_POST["passwd"]);

          if ($pwd == $typedPwd){ //verif password correct

            $_SESSION["user"]=$_POST["login"];
            header('Location: index.php?page=0');
            exit();
          }
        }
      }
      echo "<h1>Pour vous connecter</h1> <br> <img src="."image/erreur.png"."> Login, MDP ou captcha incorrect";
    }
  } else {
  header('Location: index.php?page=0');
  exit();
}


?>
