<?php
//include_once ('../function.php');
include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';
/**
/**
 * Check du formulaire d'inscription
 * @param : nom, prenom, email, telephon, login, mot de passe
 * @return : Message d'erreur si l'url n'est pas saisie correctement
 */
class Logs{

	private $message;



	public function __construct(string $message){	

		$this->message = $message;

	}
	public function GetMessage(){
		return $this->message;
	}
 	public function SaveLogs(){
 		$file = fopen( $_SERVER['DOCUMENT_ROOT']."/class/logs/logs.txt", "a+");
 		$ip = $_SERVER['REMOTE_ADDR'];
 		$date = date("Y-m-d H:i:s");
		$txt = "[".$ip."] [".$date."] ".$this->message.PHP_EOL;
		fwrite($file, $txt);
		fclose($file);
 	}
	public function __toString(){

        $out  = "<------------------Logs-----------------><br>";
        $out .= "<p> Message : ".$this->message."</p>";
        return $out;
    }

}



?>
