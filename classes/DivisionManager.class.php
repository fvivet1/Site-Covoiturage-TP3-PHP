<?php
class DivisionManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}

				public function getDivisions(){
            $listesDivision = array();

            $sql = 'SELECT div_num, div_nom FROM division';

            $requete = $this->db->prepare($sql);
            $requete->execute();
						/*echo "<pre>";
						print_r($requete->debugDumpParams());
						echo "/<pre>";*/

            while ($div = $requete->fetch(PDO::FETCH_OBJ))
                $listesDivision[] = new Division($div);

            $requete->closeCursor();
            return $listesDivision;
					}

}
