<?php
class Ville{
	private $vil_num;
	private $vil_nom;

	public function __construct($valeurs = array()){
	if (!empty($valeurs))
			 $this->affecte($valeurs);
}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'vil_nom': $this->setVilNom($valeur); break;
							case 'vil_num': $this->setVilNum($valeur); break;
					}
			}
	}

	public function getVilNum(){
			return $this->vil_num;
	}

	public function getVilNom(){
			return $this->vil_nom;
	}

	public function setVilNom($vil_nom){
			$this->vil_nom = $vil_nom;
	}

	public function setVilNum($vil_num){
			$this->vil_num = $vil_num;
	}

}
