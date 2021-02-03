<?php
if (!empty($_SESSION["user"])) {
  $pdo = new Mypdo();
  $parcoursManager = new ParcoursManager($pdo);
  $proposeManager = new ProposeManager($pdo);
  $personneManager = new PersonneManager($pdo);
  $villeManager = new VilleManager($pdo);
  $avisManager = new AvisManager($pdo);
  ?>

  <h1>Rechercher un trajet</h1>
  <?php
  if (!empty($_POST["dateDepart"]) && !empty($_POST["heure"]) && !empty($_POST["vil_arrivee"]) && !empty($_POST["precision"])) {

    $villeDepart = unserialize($_SESSION["villeDepart"]);
    $villeArrivee = $villeManager->getVilleById($_POST["vil_arrivee"]);

    $parcours = $parcoursManager->getParcoursByVilles($villeDepart->getVilNum(), $villeArrivee->getVilNum());
    $trajets = $proposeManager->getTrajetsRecherche($_POST, $parcours->getParNum());
    if (!empty($trajets)){
    ?>

    <table>
      <tr><th>Ville départ</th><th>Ville arrivée</th><th>Date départ</th><th>Heure départ</th><th>Nombre de place(s)</th><th>Nom du covoitureur</th></tr>
      <?php
      foreach($trajets as $trajet){
        $covoitureur = $personneManager->getPersonneById($trajet->getPerNum());
        $avg = number_format($avisManager->getMoyenneAvis($covoitureur->getPerNum()));
        $lastComm = $avisManager->getLastComm($covoitureur->getPerNum());
      ?>
      <tr>
        <td><?php echo $villeDepart->getVilNom() ?></td>
        <td><?php echo $villeArrivee->getVilNom() ?></td>
        <td><?php echo $trajet->getProDate() ?></td>
        <td><?php echo $trajet->getProTime() ?></td>
        <td><?php echo $trajet->getProPlace() ?></td>
        <td><acronym title="Moyenne des avis : <?php echo $avg ?>/5 Dernier avis :  <?php echo $lastComm ?>"><?php echo $covoitureur->getPerPrenom()." ".$covoitureur->getPerNom(); ?></acronym></td>
      </tr>
    <?php } ?>
    </table>

        <?php
    } else {
      echo "<img src="."image/erreur.png"."> Désolé, pas de trajet disponible !";
    }
  } else {
    if (empty($_POST["vil_dep_num"])){
      $villesDepart = $proposeManager->getVillesDepart();
      ?>
      <form name="FromRechTraj" id="FromRechTraj" method="post">
      <b>Ville de départ :<b> <br><br>
      <select name="vil_dep_num">
        <option value="">Choississez la ville de départ</option>
        <?php
        foreach ($villesDepart as $ville){
          echo "<option value=\"".$ville->getVilNum()."\">".$ville->getVilNom()."</option>";
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

        <form name="FromRechTraj2" id="FromRechTraj2" method="post">
          <div id='saisieForm'>
            <div class="formCol">
              <b>Ville de départ :</b>
              <b>Date de départ :</b>
              <b>À partir de :</b>
            </div>
            <div class="formCol">
              <b><?php echo $villeDepart->getVilNom() ?></b>
              <input type="date" name="dateDepart" value="<?php echo date('Y-m-d');?>">
              <select name="heure">
                <?php
                for($i = 1; $i <=24; $i++){
                  echo "<option value=\"".$i.":00:00\">".$i."h</option>";
                }
                ?>
              </select>
            </div>
            <div class="formCol">
              <b>Ville d'arrivée :</b>
              <b>Précision :</b>
            </div>
            <div class="formCol">
              <select name="vil_arrivee">
                <?php
                foreach ($villesDestination as $ville){
                  echo "<option value=\"".$ville->getVilNum()."\">".$ville->getVilNom()."</option>";
                }
                ?>
              </select>
              <select name="precision">
                <option value="j">Ce jour</option>
                <option value="1">+/- 1 jour</option>
                <option value="2">+/- 2 jours</option>
                <option value="3">+/- 3 jours</option>
              </select>
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
