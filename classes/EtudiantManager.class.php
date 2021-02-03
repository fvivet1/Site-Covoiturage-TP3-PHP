<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function add($etudiant, $num){
		$requete = $this->db->prepare(
		'INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num)'
		);
		$requete->bindValue(':per_num',$num);
		$requete->bindValue(':dep_num',$etudiant->getDepNum());
		$requete->bindValue(':div_num',$etudiant->getDivNum());


		$retour=$requete->execute();
		/*echo "<pre>";
		print_r($requete->debugDumpParams());
		echo "/<pre>";*/
		return $retour;
}

public function getEtudiantById($per_num){

		$sql = 'SELECT * FROM etudiant WHERE per_num='.$per_num;

		$requete = $this->db->prepare($sql);
		$requete->execute();
		/*echo "<pre>";
		print_r($requete->debugDumpParams());
		echo "/<pre>";*/

		while ($etudiant = $requete->fetch(PDO::FETCH_OBJ)){
				$newEtudiant = new Etudiant($etudiant);
		}
		$requete->closeCursor();
		return $newEtudiant;
	}

public function getEtudiants(){
		$listeEtudiants = array();

		$sql = 'SELECT * FROM etudiant';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
				$listeEtudiants[] = new Etudiant($etudiant);

		$requete->closeCursor();
		return $listeEtudiants;
	}


}
