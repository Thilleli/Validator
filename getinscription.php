<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/inscription/forminscription.php';

//----------------------------------------------------------------------------------------------

if(!empty($_POST)){
	
		$nom = htmlspecialchars(strip_tags($_POST['nom']));
		$prenom = htmlspecialchars(strip_tags($_POST['prenom']));
		$mail = htmlspecialchars(strip_tags($_POST['mail']));
		$tel =  "0" . strval(htmlspecialchars(strip_tags($_POST['tel'])));
		$login =  htmlspecialchars(strip_tags($_POST['login']));
		$password = $_POST['password'];

		//chiffrer le mot de passe en utilisant une clé aléatoire
    	$key_chiffrement=random_key($length=20);
    	$pwdhash=hash("sha512", $password.$key_chiffrement);

			$Inscription = new FormInscription($nom,$prenom,$mail, $tel,$login, $pwdhash,$key_chiffrement);
			$check = $Inscription->CheckForm();
			
			if ($check){
				$obj = json_decode($check);
				

				$tab["check"]=$obj;
				
			}
		print_r(json_encode($tab));
}
?>