<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------

if(isset($_SESSION["id_user"])){
	//Recuperer les informations de l'utilisateur
	$session=$_SESSION['id_user'];
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	$request=("SELECT * FROM user WHERE id_user='$session'");
	$data= $ConnexionBDD->getResults($conn,$request);
	while ($row = $data -> fetch_array(MYSQLI_NUM)) {
	
		$nom=$row[1];
		$prenom=$row[2];
		$email=$row[3];
		$PhoneNumber=$row[4];
		$login=$row[5];
	}
	// Code pour supprimer l'historique de l'utilisateur connecter
	if (!empty($_POST['delete'])) {
		if(!DeleteHistorique($_SESSION["id_user"])){
			$Message = "ERREUR";
			$Logs = New Logs('à essayer de supprimer son historique mais une erreur est subvenu ');
			$Logs->SaveLogs();
		}
		else{
			$Logs = New Logs('à supprimer son historique ' );
			$Logs->SaveLogs();
		}
	}
	//Code pour modifier le profil
	/*elseif (!empty($_POST['edit'])) {
		echo "EDIIT";
	}*/
?>
 <?php echo Nav('Profil');
 if (!empty($Message)) {
 	echo '<div class="alert alert-danger text-center mt-4" role="alert">'.$Message."</div>";
 }
 ?>

		<div class="card">
		  <div class="card-body">
		    <h4 class="card-title"><strong>Mes informations personnelles:</strong></h4>
		  		<center><img src="/style/profil.png"></center>
		    <p class="card-text"><strong>Nom:</strong> <?= $nom; ?></p>
		    <p class="card-text"><strong>Prénom:</strong> <?= $prenom; ?></p>
		    <p class="card-text"><strong>Login:</strong> <?= $login; ?></p>
		    <p class="card-text"><strong>Adresse mail:</strong> <?= $email; ?></p>
		    <p class="card-text"><strong>Numéro de téléphone:</strong> 0<?= $PhoneNumber; ?></p>
	
		  </div>
		</div>

		<div class="card">
		  <div class="card-body">
		    <h4 class="card-title"><strong>Historiques:</strong></h4>
		    <form method="post" id="Delete">
			<?php
			echo '<p>'.SeeHistorique($_SESSION["id_user"]).'</p>';?>

		    <input id="delete" name="delete" type="hidden" value="delete">
			<input  type="submit" id="delete" name="delete" class="btn btn-primary" value="Supprimer l'historique">
			</form>
		  </div>
		</div>


	
	<?php



	 echo Footer(); ?>

<?php }else{
	header('Location: /index.php');
} ?>