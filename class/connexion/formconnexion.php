<?php
//include_once ('../function.php');
include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';
/**
/**
 * Check du formulaire d'inscription
 * @param : nom, prenom, email, telephon, login, mot de passe
 * @return : Message d'erreur si l'url n'est pas saisie correctement
 */
class FormConnexion{

	private $login;
	private $password;



	public function __construct(string $login, string $password){	

		$this->login = $login;
		$this->password = $password;

	}
	public function GetLogin(){
		return $this->login;
	}
	public function GetPassword(){
		return $this->password;
	}

 	public function CheckForm(){
 			
 			$message=false;
			if (!empty($this->login) AND !empty($this->password) ) {
				$ConnexionOk=false;
 				$UserExist=verifUser($this->login,$this->password);
				 //-----------------------------------------------------------
				if ($UserExist){

					$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
					$conn = $ConnexionBDD->OpenCon();
					 
					$request =  ("SELECT * FROM user WHERE login_user='$this->login' AND mdp_user='$this->password'");
					$result = $ConnexionBDD->getResults($conn,$request);
					while ($row = $result -> fetch_array(MYSQLI_NUM)) {
						$_SESSION['id_user']=$row["id_user"];
	              		$_SESSION['nom_user'] = $row["nom_user"];
	              		$_SESSION['prenom_user'] = $row["prenom_user"];
	              		$_SESSION['mail_user'] = $row["mail_user"];
	              		$_SESSION['tel_user'] = $row["tel_user"];
	              		$_SESSION['login_user'] = $row["login_user"];

					
					}
					$ConnexionOk=TRUE;

				}
				//afficher les resultat en json
			      $tab["ConnexionOk"]=$ConnexionOk;
			      $tab["UserExist"]=$UserExist;	
				
			}
			else{
				$message=TRUE;
				$tab["errorMessage"]=$message;
				
			}
			
			return (json_encode($tab));
	}
	public function __toString(){

        $out  = "<------------------Info User-----------------><br>";
        $out .= "<p> Login : ".$this->login."</p>";
        $out .= "<p> Mot de passe: ". $this->password ."</p>";
        return $out;
    }

}



?>
