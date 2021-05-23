<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';

 //----------------------------------------------------------------------------------------------
	if (!empty($_SESSION['id_user'])) {
	echo Nav('Contact'); //Menu de navigation
?>
	<div class="Contact">
			<h4><img src="images/phone.png" width="50px" height="50px" /><strong>Par téléphone:</strong></h4>
			<p>Thilleli:07 67 73 30 79</p><p>Alexandra:06 52 07 68 14</p>

			<h4><img src="images/courriel.png" width="50px" height="50px"/><strong>Par courriel:</strong></h4>
			<p>th.belhocine@gmail.com</p><p>alex.wasef@gmail.com</p>

			<h4><img src="images/git.png" width="50px" height="50px" /><strong>N'hésitez pas à aller jeter un coup d'oeil sur nos pages github:</strong></h4>
			<p><a href="https://github.com/Thilleli/"/>Thilleli</p>
			<p><a href="https://github.com/wasef81194/"/>Alexandra</p>
	</div>	
			
<?php 
	}else{
		echo Nav('Contact');
?>

	<div class="Contact">
			<h4><img src="images/phone.png" width="50px" height="50px" /><strong>Par téléphone:</strong></h4>
			<p>Thilleli:07 67 73 30 79</p><p>Alexandra:06 52 07 68 14</p>

			<h4><img src="images/courriel.png" width="50px" height="50px"/><strong>Par courriel:</strong></h4>
			<p>th.belhocine@gmail.com</p><p>alex.wasef@gmail.com</p>

			<h4><img src="images/git.png" width="50px" height="50px" /><strong>N'hésitez pas à aller jeter un coup d'oeil sur nos pages github:</strong></h4>
			<p><a href="https://github.com/Thilleli/"/>Thilleli</p>
			<p><a href="https://github.com/wasef81194/"/>Alexandra</p>
	</div>

			
<?php
	}echo Footer();
?>


