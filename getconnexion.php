<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------

if(!empty($_POST)){
	
		$login =  htmlspecialchars(strip_tags($_POST['login']));
		$password = $_POST['password'];

		//connexion a la base de donnéesafin de récuperer la clé de chiffrement
		$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
		$conn = $ConnexionBDD->OpenCon();
		 
		$request =  ("SELECT key_chiffrement FROM user WHERE login_user='$login'");
		$result = $ConnexionBDD->getResults($conn,$request);
		while ($key = $result -> fetch_array(MYSQLI_NUM)) {
			$cle_chiffrement=$key[0];
		}
		$pwdhash=hash("sha512", $password.$cle_chiffrement);

			$Connexion = new FormConnexion($login, $pwdhash);
			$check = $Connexion->CheckForm();
			
			if ($check){
				$obj = json_decode($check);
				

				$tab["check"]=$obj;
				
			}
		print_r(json_encode($tab));
}
?>