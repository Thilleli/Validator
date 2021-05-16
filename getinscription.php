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

			$Inscription = new FormInscription($nom,$prenom,$mail, $tel,$login, $password);
			$check = $Inscription->CheckForm();
			
			if ($check){
				$obj = json_decode($check);
				

				$tab["check"]=$obj;
				
			}
		print_r(json_encode($tab));
}
?>