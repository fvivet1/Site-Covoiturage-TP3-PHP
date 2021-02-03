<?php
class Avis{
  private $per_num;
  private $per_per_num;
  private $par_num;
  private $avi_comm;
  private $avi_note;
  private $avi_date;

  public function __construct($valeurs = array()){
		if (!empty($valeurs))
		 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur) {
			switch($attribut) {
        case 'per_num': $this->setPerNum($valeur); break;
        case 'per_per_num': $this->setPerPerNum($valeur); break;
        case 'par_num': $this->setParNum($valeur); break;
        case 'avi_comm': $this->setAviComm($valeur); break;
        case 'avi_note': $this->setAviNote($valeur); break;
        case 'avi_date': $this->setAviDate($valeur); break;
			}
		}
	}



  public function getPerNum() {
    return $this->per_num;
  }

  public function getPerPerNum() {
    return $this->per_per_num;
  }

  public function getParNum() {
    return $this->par_num;
  }

  public function getAviComm() {
    return $this->avi_comm;
  }

  public function getAviNote() {
    return $this->avi_note;
  }

  public function getAviDate() {
    return $this->avi_date;
  }

  public function setPerNum($per_num) {
    $this->per_num=$per_num;
  }

  public function setPerPerNum($per_per_num) {
    $this->per_per_num=$per_per_num;
  }

  public function setParNum($par_num) {
    $this->par_num=$par_num;
  }

  public function setAviComm($avi_comm) {
    $this->avi_comm=$avi_comm;
  }

  public function setAviNote($avi_note) {
    $this->avi_note=$avi_note;
  }

  public function setAviDate($avi_date) {
    $this->avi_date=$avi_date;
  }


} ?>
