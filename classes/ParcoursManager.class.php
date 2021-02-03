<?php
class ParcoursManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($parcours){
            $requete = $this->db->prepare("INSERT INTO parcours (par_km, vil_num1, vil_num2 ) VALUES (:par_km, :vil_num1, :vil_num2)");
						$requete->bindValue(':par_km',$parcours->getParKm());
            $requete->bindValue(':vil_num1',$parcours->getVilNum1());
						$requete->bindValue(':vil_num2',$parcours->getVilNum2());


            $retour=$requete->execute();
						/*echo "<pre>";
						print_r($requete->debugDumpParams());
						echo "/<pre>";*/
						return $retour;
        }

				public function getParcours(){
            $listeParcours = array();

            $sql = 'SELECT * FROM parcours';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
                $listeParcours[] = new Parcours($parcours, $this->db);

            $requete->closeCursor();
            return $listeParcours;
					}

					public function getParcoursByVilles($vil_dep, $vil_arr){

	            $sql = "SELECT * FROM parcours WHERE (vil_num1=$vil_arr AND vil_num2=$vil_dep) OR (vil_num2=$vil_arr AND vil_num1=$vil_dep)";

	            $requete = $this->db->prepare($sql);
	            $requete->execute();

	            while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
	                $newParcours = new Parcours($parcours, $this->db);

	            $requete->closeCursor();
	            return $newParcours;
						}

					public function getVillesDesservies(){
	            $listeVillesDesservies = array();

	            $sql = 'SELECT DISTINCT vil_num, vil_nom FROM ville, parcours WHERE vil_num=vil_num1 OR vil_num=vil_num2 GROUP BY vil_num';

	            $requete = $this->db->prepare($sql);
							/*echo "<pre>";
							print_r($requete->debugDumpParams());
							echo "/<pre>";*/
	            $requete->execute();

	            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
	                $listeVillesDesservies[] = new Ville($ville);

	            $requete->closeCursor();
	            return $listeVillesDesservies;
						}

						public function getVillesDestination($vil_num){
		            $listeVillesDesservies = array();

		            $sql = "SELECT vil_num, vil_nom FROM ville, parcours WHERE (vil_num = vil_num1 AND vil_num2 = $vil_num) OR (vil_num = vil_num2 AND vil_num1 = $vil_num) GROUP BY vil_num";

		            $requete = $this->db->prepare($sql);
								/*echo "<pre>";
								print_r($requete->debugDumpParams());
								echo "/<pre>";*/
		            $requete->execute();

		            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
		                $listeVillesDesservies[] = new Ville($ville);

		            $requete->closeCursor();
		            return $listeVillesDesservies;
							}

}
