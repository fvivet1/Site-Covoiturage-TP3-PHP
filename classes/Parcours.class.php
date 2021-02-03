<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $ville1;
	private $ville2;
	private $db;

	public function __construct($valeurs = array(), $db){
	$this->db = $db;
	if (!empty($valeurs))
			 $this->affecte($valeurs);
	}

	public function affecte($donnees){

			foreach ($donnees as $attribut => $valeur){

					switch ($attribut){
							case 'par_km' : $this->setParKm($valeur); break;
							case 'par_num': $this->setParNum($valeur); break;
							case 'vil_nom1': $this->setVille1($attribut, $valeur); break;
							case 'vil_num1':$this->setVille1($attribut, $valeur);	break;
							case 'vil_nom2': $this->setVille2($attribut, $valeur); break;
							case 'vil_num2':$this->setVille2($attribut, $valeur); break;
					}
			}
	}

	public function getVilNum1(){
			return ($this->ville1)->getVilNum();
	}

	public function getVilNum2(){
			return ($this->ville2)->getVilNum();
	}

	public function getVilNom1(){
		 	return ($this->ville1)->getVilNom();
	}

	public function getVilNom2(){
		 	return ($this->ville2)->getVilNom();
	}

	public function getParKm(){
			return $this->par_km;
	}

	public function getParNum(){
			return $this->par_num;
	}

	public function setVille1($attribut, $valeur){
		if ($attribut=='vil_nom1')
		{
			$sql = 'SELECT * FROM ville WHERE vil_nom =\''.$valeur.'\'';
		}
		else {
			$sql = 'SELECT * FROM ville WHERE vil_num ='.$valeur;
		}
		$requete = $this->db->prepare($sql);
		$requete->execute();
		/*echo "<pre>";
		print_r($requete->debugDumpParams());
		echo "/<pre>";*/

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
				$vil1 = new Ville($ville);

		$requete->closeCursor();
		$this->ville1 = $vil1;
	}

	public function setVille2($attribut, $valeur){
		if ($attribut=='vil_nom2')
		{
			$sql = 'SELECT * FROM ville WHERE vil_nom =\''.$valeur.'\'';
		}
		else {
			$sql = 'SELECT * FROM ville WHERE vil_num ='.$valeur;
		}
		$requete = $this->db->prepare($sql);
		$requete->execute();
		/*echo "<pre>";
		print_r($requete->debugDumpParams());
		echo "/<pre>";*/

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
				$vil2 = new Ville($ville);

		$requete->closeCursor();
		$this->ville2 = $vil2;
	}

	public function setParKm($par_km){
			$this->par_km = $par_km;
	}

	public function setParNum($par_num){
			$this->par_num = $par_num;
	}
}
