<?php
class AvisManager{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getMoyenneAvis($per_num){

      $sql = "SELECT AVG(avi_note) as result FROM avis WHERE per_num = $per_num";

      $requete = $this->db->prepare($sql);
      $requete->execute();
      /*echo "<pre>";
      print_r($requete->debugDumpParams());
      echo "/<pre>";*/

      while ($moyavis = $requete->fetch(PDO::FETCH_ASSOC))
          $moyenne = $moyavis['result'];

      $requete->closeCursor();
      return $moyenne;
    }

    public function getLastComm($per_num){

      $sql = "SELECT avi_comm FROM avis WHERE per_num = $per_num ORDER BY avi_date DESC LIMIT 1";

      $requete = $this->db->prepare($sql);
      $requete->execute();
      /*echo "<pre>";
      print_r($requete->debugDumpParams());
      echo "/<pre>";*/

      $lastComm =" --- "; //Cas où il n'y a pas d'avis
      while ($comm = $requete->fetch(PDO::FETCH_ASSOC))
          $lastComm = $comm['avi_comm'];

      $requete->closeCursor();
      return $lastComm;
    }
}
?>
