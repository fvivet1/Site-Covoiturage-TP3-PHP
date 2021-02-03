<?php

if (!empty($_SESSION["user"])){
  $pdo = new Mypdo();
  $parcoursManager = new ParcoursManager($pdo);
  $villeManager = new VilleManager($pdo);

  if(!empty($_POST["dateDepart"]) && !empty($_POST["nbPlaces"]) && !empty($_POST["vil_arrivee"]) && !empty($_POST["heureDepart"])){
    $proposeManager = new ProposeManager($pdo);
    $personneManager = new PersonneManager($pdo);
    $villeDepart = unserialize($_SESSION["villeDepart"]);
    $parcours = $parcoursManager->getParcoursByVilles( $villeDepart->getVilNum(), $_POST["vil_arrivee"]);

    $par_num = $parcours->getParNum();
    $per_num = $personneManager->getPersonneByLogin($_SESSION["user"])->getPerNum();
    $pro_date = $_POST["dateDepart"];
    $pro_time = $_POST["heureDepart"];
    $pro_place = $_POST["nbPlaces"];

    if ($villeDepart->getVilNum() ==$parcours->getVilNum1()){
      $pro_sens = 0;
    }else{
      $pro_sens =1;
    }

    $propose = Array("par_num"=>$par_num, "per_num"=>$per_num, "pro_date"=>$pro_date, "pro_time"=>$pro_time, "pro_place"=>$pro_place, "pro_sens"=>$pro_sens);
    $trajet = new Propose($propose);
    $retour=$proposeManager->add($trajet);

    if ($retour==1){
      echo "<img src="."image/valid.png"."> Le trajet a bien été ajoutée";
    }


  } else {

    $villesDesservies = $parcoursManager->getVillesDesservies();

    ?>
    <h1>Proposer un trajet</h1>
    <?php
    if (empty($_POST["vil_dep_num"])){

    ?>
    <form name="FromPropTraj" id="FromPropTraj" method="post">
    <b>Ville de départ :<b> <br><br>
    <select name="vil_dep_num">
      <option value="">Choississez la ville de départ</option>
      <?php
      foreach ($villesDesservies as $ville){
        echo "<option type=\"submit\" value=\"".$ville->getVilNum()."\">".$ville->getVilNom()."</option>";
      }
      ?>
    </select>
    <input type="submit" value="Valider">
    </form>

    <?php
    } else {
      $villeDepart = $villeManager->getVilleById($_POST["vil_dep_num"]);
      $_SESSION["villeDepart"] = serialize($villeDepart);
      $villesDestination = $parcoursManager->getVillesDestination($villeDepart->getVilNum());

      ?>

      <form name="FromPropTraj2" id="FromPropTraj2" method="post">
        <div id='saisieForm'>
          <div class="formCol">
            <b>Ville de départ :</b>
            <b>Date de départ :</b>
            <b>Nombre de places :</b>
          </div>
          <div class="formCol">
            <b><?php echo $villeDepart->getVilNom() ?></b>
            <input type="date" name="dateDepart" value="<?php echo date('Y-m-d');?>">
            <input type="number" name="nbPlaces">
          </div>
          <div class="formCol">
            <b>Ville d'arrivée :</b>
            <b>Heure de départ :</b>
          </div>
          <div class="formCol">
            <select name="vil_arrivee">
              <option value="">Choississez la ville de destination</option>
              <?php
              foreach ($villesDestination as $ville){
                echo "<option type=\"submit\" value=\"".$ville->getVilNum()."\">".$ville->getVilNom()."</option>";
              }
              ?>
            </select>
            <input type="time" name="heureDepart" value="<?php echo date("H:i"); ?>">
          </div>
        </div>

      <input type="submit" value="Valider">
      </form>


      <?php
    }
  }
} else {
  ?> <h1>Accès non-autorisé</h1>
  Connectez-vous pour accéder à cette page <?php
}
?>
