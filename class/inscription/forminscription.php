<?php
//include_once ('../function.php');
include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/class/logs/logs.php';
/**
/**
 * Check du formulaire d'inscription
 * @param : nom, prenom, email, telephon, login, mot de passe
 * @return : Message d'erreur si l'url n'est pas saisie correctement
 */
class FormInscription{

	private $nom;
	private $prenom;
	private $mail;
	private $tel;
	private $login;
	private $password;
	private $key_chiffrement;



	public function __construct(string $nom, string $prenom, string $mail, int $tel,  string $login, string $password,string $key_chiffrement){	

		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->mail = $mail;
		$this->tel = $tel;
		$this->login = $login;
		$this->password = $password;
		$this->key_chiffrement = $key_chiffrement;

	}
	public function GetNom(){
		return $this->nom;
	}
	public function GetPrenom(){
		return $this->prenom;
	}
	public function GetMail(){
		return $this->mail;
	}
	public function GetTel(){
		return $this->tel;
	}
	public function GetLogin(){
		return $this->login;
	}
	public function GetPassword(){
		return $this->password;
	}
	public function GetKey(){
		return $this->key_chiffrement;
	}

 	public function CheckForm(){
 			
 			$message=false;
			if (!empty($this->nom) AND !empty($this->prenom) AND !empty($this->mail) AND !empty($this->tel) AND !empty($this->login) AND !empty($this->password) ) {
				$inscriptionOk=false;
 				$LoginExist=LoginExist($this->login);
      			$MailExist=MailExist($this->mail);
				 //-----------------------------------------------------------
				if ((!$MailExist AND !$LoginExist)) {
					smtpmailer($this->mail, $this->nom, $this->prenom,$this->key_chiffrement);
					InsertUser($this->nom,$this->prenom,$this->mail,$this->tel,$this->login,$this->password,$this->key_chiffrement);
					$inscriptionOk=TRUE;
					$Logs = New Logs('à été inscrit ');
					$Logs->SaveLogs();

				}
				else{

					$Logs = New Logs('à renseigné une adresse mail ou un login déja pris pour s\'inscrire');
					$Logs->SaveLogs();
				}
				//afficher les resultat en json
			      $tab["inscriptionOk"]=$inscriptionOk;
			      $tab["mailExist"]=$MailExist;
			      $tab["loginExist"]=$LoginExist;	
				
			}
			else{
				$message=TRUE;
				$tab["errorMessage"]=$message;
				$Logs = New Logs('n\'a pas remplies l\'intégralité du formulaire d\'inscription');
				$Logs->SaveLogs();
				
			}
			
			return (json_encode($tab));
	}
	public function __toString(){

        $out  = "<------------------Info User-----------------><br>";
        $out .= "<p> Nom : ".$this->nom."</p>";
        $out .= "<p> Prénom : ".$this->prenom."</p>";
        $out .= "<p> Mail : ".$this->mail."</p>";
        if (!empty($this->tel)) {
        	 $out .= "<p> Tel : ".$this->tel."</p>";
        }
        $out .= "<p> Login : ".$this->login."</p>";
        $out .= "<p> Mot de passe: ". $this->password ."</p>";
        $out .= "<p> Key: ". $this->key_chiffrement ."</p>";
        return $out;
    }

}



?>
