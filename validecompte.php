<?php 

include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';

include_once $_SERVER['DOCUMENT_ROOT']. '/class/bdd/connexionbdd.php';

include_once $_SERVER['DOCUMENT_ROOT']. '/class/logs/logs.php';
//---------------------------------------------------------------------------------
echo Nav('Validation de compte');
if (!empty($_GET['key'])) {
	$key = $_GET['key'];
	$date_end = $_GET['date'];
	$date = date('Y-m-d|H:i:s');
	//echo $date.'<br>';
	//echo $date_end;
	if (verifkey($key)) {
		if ($date<$date_end) {
			if(CompteReady($key)){
				$Logs = New Logs('à valider son adresse mail');
				$Logs->SaveLogs();
				echo '<div class="alert alert-success text-center mt-4" role="alert"> Bravo ! Votre mail a été confirmé vous pouvez désormais vous connecter </div>';
				header('refresh:5;url=connexion.php');

			}
		}
		else{
			$Logs = New Logs('a dépassé le temps impartie pour valider son adresse mail');
			$Logs->SaveLogs();
			DeleteCompte($key);
			echo '<div class="alert alert-danger text-center mt-4" role="alert"> la date a expiré</div>';
		}
	}	
	else{
		$Logs = New Logs('a entré une clé incorrect pour valider son adresse mail');
		$Logs->SaveLogs();
		echo ' <div class="alert alert-danger text-center mt-4" role="alert"> Votre clé n\'existe pas</div>';
	}

}
else {
	$Logs = New Logs('n\'a  pas entré de clé pour valider son adresse mail');
	$Logs->SaveLogs();
	echo '<div class="alert alert-danger text-center mt-4" role="alert">Erreur</div>';
}
echo Footer();

 ?>