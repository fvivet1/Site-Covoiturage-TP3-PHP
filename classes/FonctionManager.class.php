<?php
class FonctionManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getFonctionById($fon_num){

				$sql = 'SELECT fon_num, fon_libelle FROM fonction WHERE fon_num='.$fon_num;

				$requete = $this->db->prepare($sql);
				$requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

				while ($fon = $requete->fetch(PDO::FETCH_OBJ))
						$newFonction = new Fonction($fon);

				$requete->closeCursor();
				return $newFonction;
			}

		public function getFonctions(){
        $listesFonction = array();

        $sql = 'SELECT fon_num, fon_libelle FROM fonction';

        $requete = $this->db->prepare($sql);
        $requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

        while ($fon = $requete->fetch(PDO::FETCH_OBJ))
            $listesFonction[] = new Fonction($fon);

        $requete->closeCursor();
        return $listesFonction;
			}

}
