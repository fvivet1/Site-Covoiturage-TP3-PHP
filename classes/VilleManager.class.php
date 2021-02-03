<?php
class VilleManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($ville){
            $requete = $this->db->prepare(
						'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');

            $requete->bindValue(':vil_nom',$ville->getVilNom());

            $retour=$requete->execute();
						/*echo "<pre>";
						print_r($requete->debugDumpParams());
						echo "/<pre>";*/
						return $retour;
        }

				public function getVilleById($vil_num){

						$sql = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num='.$vil_num;

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($ville = $requete->fetch(PDO::FETCH_OBJ))
								$newVille = new Ville($ville);

						$requete->closeCursor();
						return $newVille;
					}

				public function getVilles(){
            $listeVilles = array();

            $sql = 'SELECT vil_num, vil_nom FROM ville';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
                $listeVilles[] = new Ville($ville);

            $requete->closeCursor();
            return $listeVilles;
					}

}
