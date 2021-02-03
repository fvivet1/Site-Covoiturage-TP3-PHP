<?php //A COMPLETER
class Division{
	private $div_num;
	private $div_nom;


	public function __construct($valeurs = array()){
		if (!empty($valeurs))
		 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur){
				switch ($attribut){
					  case 'div_num': $this->setDivNum($valeur); break;
						case 'div_nom': $this->setDivNom($valeur); break;
				}
		}
	}

	public function getDivNum(){
			return $this->div_num;
	}

	public function getDivNom(){
			return $this->div_nom;
	}

	public function setDivNum($div_num){
			$this->div_num = $div_num;
	}

	public function setDivNom($div_nom){
			$this->div_nom = $div_nom;
	}



}
