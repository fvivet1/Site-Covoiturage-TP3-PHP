<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function add($personne){
			$requete = $this->db->prepare(
			'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd);');

			$requete->bindValue(':per_nom',$personne->getPerNom());
			$requete->bindValue(':per_prenom',$personne->getPerPrenom());
			$requete->bindValue(':per_tel',$personne->getPerTel());
			$requete->bindValue(':per_mail',$personne->getPerMail());
			$requete->bindValue(':per_login',$personne->getPerLogin());
			$requete->bindValue(':per_pwd',$this->encryptPasswd($personne->getPerPwd()));

			$retour=$requete->execute();
			/*echo "<pre>";
			print_r($requete->debugDumpParams());
			echo "/<pre>";*/
			$num = $this->db->lastInsertId();
			return $num;
	}



		public function getPersonnes(){
				$listesDivision = array();

				$sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne';

				$requete = $this->db->prepare($sql);
				$requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

				while ($personne = $requete->fetch(PDO::FETCH_OBJ))
						$listesPersonnes[] = new Personne($personne);

				$requete->closeCursor();
				return $listesPersonnes;
		}

	public function getPersonneById($per_num){

			$sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne WHERE per_num='.$per_num;

			$requete = $this->db->prepare($sql);
			$requete->execute();
			/*echo "<pre>";
			print_r($requete->debugDumpParams());
			echo "/<pre>";*/

			while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
					$newPersonne = new Personne($personne);
			}
			$requete->closeCursor();
			return $newPersonne;
	}

	public function getPersonneByLogin($login){

			$sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne WHERE per_login=\"".$login."\"";

			$requete = $this->db->prepare($sql);
			$requete->execute();
			/*echo "<pre>";
			print_r($requete->debugDumpParams());
			echo "/<pre>";*/

			while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
					$newPersonne = new Personne($personne);
			}
			$requete->closeCursor();
			return $newPersonne;
	}

	public function existe($per_login){
			$sql = "SELECT * FROM personne WHERE per_login=\"".$per_login."\"";

			$requete = $this->db->prepare("SELECT EXISTS($sql)");
			$requete->execute();

			if ($requete->fetchColumn()==1){
				$existe=true;
			} else {
				$existe=false;
			}

			$requete->closeCursor();
			return $existe;
	}



	public function getPasswdByLogin($per_login){

				$sql = "SELECT * FROM personne WHERE per_login=\"".$per_login."\"";

				$requete = $this->db->prepare($sql);
				$requete->execute();
				/*echo "<pre>";
				print_r($requete->debugDumpParams());
				echo "/<pre>";*/

				while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
						$newPersonne = new Personne($personne);
				}

				$requete->closeCursor();
				return $newPersonne->getPerPwd();
	}



	public function encryptPasswd($passwd){
			$cryptedPwd = sha1(sha1($passwd).SALT);
			return $cryptedPwd;
	}



	public function getCategorieById($per_num){
			$sql = 'SELECT * FROM etudiant WHERE per_num='.$per_num;

			$requete = $this->db->prepare("SELECT EXISTS($sql)");
			$requete->execute();

			if ($requete->fetchColumn()==1){
				$cat="etudiant";
			} else {
				$cat="salarie";
			}

			$requete->closeCursor();
			return $cat;
	}


}
