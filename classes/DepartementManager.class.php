<?php
class DepartementManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getDepartementById($dep_num){

				$sql = 'SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num='.$dep_num;

				$requete = $this->db->prepare($sql);
				$requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

				while ($dep = $requete->fetch(PDO::FETCH_OBJ))
						$newDepartement = new Departement($dep);

				$requete->closeCursor();
				return $newDepartement;
		}

		public function getDepartements(){
        $listesDepartements = array();

        $sql = 'SELECT dep_num, dep_nom, vil_num FROM departement';

        $requete = $this->db->prepare($sql);
        $requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

        while ($dep = $requete->fetch(PDO::FETCH_OBJ))
            $listesDepartements[] = new Departement($dep);

        $requete->closeCursor();
        return $listesDepartements;
		}
}
