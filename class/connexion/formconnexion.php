<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/class/logs/logs.php';

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
 				$User_Validated= user_validated($this->login,$this->password);
				 //-----------------------------------------------------------
				if ($UserExist AND $User_Validated){

					
					$ConnexionOk=TRUE;
					$Logs = New Logs('à été connecté ');
					$Logs->SaveLogs();

				}
				else{
					$Logs = New Logs('n\'a pas renseigné les bonnes informations pour se connecter');
					$Logs->SaveLogs();
				}
				//afficher les resultat en json
			      $tab["ConnexionOk"]=$ConnexionOk;
			      $tab["UserExist"]=$UserExist;
			      $tab["UserValidated"]=$User_Validated;	
				
			}
			else{
				$message=TRUE;
				$tab["errorMessage"]=$message;
				$Logs = New Logs('n\'a pas remplies l\'intégralité du formulaire de connexion ');
				$Logs->SaveLogs();
				
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
