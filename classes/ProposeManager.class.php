<?php
class ProposeManager{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
        public function add($propose){
            $requete = $this->db->prepare(
                'INSERT INTO propose (par_num,per_num,pro_date,pro_time,pro_place,pro_sens)
                 VALUES (:par_num, :per_num, :pro_date,:pro_time,:pro_place, :pro_sens);');


            $requete->bindValue(':par_num',$propose->getParNum());
            $requete->bindValue(':per_num',$propose->getPerNum());
            $requete->bindValue(':pro_date',$propose->getProDate());
            $requete->bindValue(':pro_time',$propose->getProTime());
            $requete->bindValue(':pro_place',$propose->getProPlace());
            $requete->bindValue(':pro_sens',$propose->getProSens());

            $retour=$requete->execute();
            return $retour;
        }

        public function getTrajets(){
          $listeTrajets = array();

          $sql = 'SELECT * FROM propose';

          $requete = $this->db->prepare($sql);
          $requete->execute();

          while ($propose = $requete->fetch(PDO::FETCH_OBJ))
              $listeTrajets[] = new Propose($propose);

          $requete->closeCursor();
          return $listeTrajets;
        }

        public function getVillesDepart(){
          $listeVilles = array();

          $sql = "SELECT DISTINCT v.vil_num, v.vil_nom FROM propose pr, parcours pa, ville v WHERE pr.par_num=pa.par_num AND ((pa.vil_num1=v.vil_num AND pr.pro_sens=0) OR (pa.vil_num2=v.vil_num AND pr.pro_sens=1))";

          $requete = $this->db->prepare($sql);
          $requete->execute();

          while ($ville = $requete->fetch(PDO::FETCH_OBJ))
              $listeVilles[] = new Ville($ville);

          $requete->closeCursor();
          return $listeVilles;
        }

        public function getTrajetsRecherche($donnees = array(), $par_num){
          foreach($donnees as $attribut => $valeur) {
      			switch($attribut) {
      				case 'dateDepart': $dateDepart = $valeur; break;
              case 'heure': $heureMin = $valeur; break;
              case 'vil_arrivee': $vil_arrivee = $valeur; break;
              case 'precision': $precision = $valeur;
                                if ($precision == "j") { $precision = 0;}
                  break;
      			}
          }

          $listeTrajets = array();

          $sql ="SELECT par_num, per_num, pro_date, pro_time, pro_place, pro_sens FROM propose pr
          WHERE pro_date BETWEEN ('$dateDepart' - INTERVAL $precision DAY) AND ('$dateDepart' + INTERVAL $precision DAY) AND pro_time >= '$heureMin' AND pr.par_num = $par_num ORDER BY pro_date, pro_time";

          $requete = $this->db->prepare($sql);
          $requete->execute();
          /*echo "<pre>";
    			print_r($requete->debugDumpParams());
    			echo "/<pre>";*/

          while ($trajet = $requete->fetch(PDO::FETCH_OBJ))
              $listeTrajets[] = new Propose($trajet);

          $requete->closeCursor();
          return $listeTrajets;
        }

        

}
