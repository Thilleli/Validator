<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------

if(!empty($_POST)){
	
		$login =  htmlspecialchars(strip_tags($_POST['login']));
		$password = $_POST['password'];

			$Connexion = new FormConnexion($login, $password);
			$check = $Connexion->CheckForm();
			
			if ($check){
				$obj = json_decode($check);
				

				$tab["check"]=$obj;
				
			}
		print_r(json_encode($tab));
}
?>