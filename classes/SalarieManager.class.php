<?php
class SalarieManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function add($salarie, $num){
		$requete = $this->db->prepare(
		'INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num)'
		);
		$requete->bindValue(':per_num',$num);
		$requete->bindValue(':sal_telprof',$salarie->getSalTelProf());
		$requete->bindValue(':fon_num',$salarie->getFonNum());


		$retour=$requete->execute();
		/*echo "<pre>";
		print_r($requete->debugDumpParams());
		echo "/<pre>";*/
		return $retour;
	}

	public function getSalarieById($per_num){

			$sql = 'SELECT * FROM salarie WHERE per_num='.$per_num;

			$requete = $this->db->prepare($sql);
			$requete->execute();

			while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
					$newSalarie = new Salarie($salarie);

			$requete->closeCursor();
			return $newSalarie;
		}

	public function getSalaries(){
		$listeSalarie = array();

		$sql = 'SELECT * FROM salarie';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
				$listeSalarie[] = new Salarie($salarie);

		$requete->closeCursor();
		return $listeSalarie;
		}


}
