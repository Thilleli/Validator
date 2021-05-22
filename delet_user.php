<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
//----------------------------------------------------------------------------------------------

if(isset($_SESSION["id_user"])){
	//Recuperer les informations de l'utilisateur
	$session=$_SESSION['id_user'];

	echo DeleteUser($session);
	$_SESSION = array();
	session_destroy();

	header('Location: index.php?msg=1');
	$Logs=New Logs('c\'est désinscrit du site');
	$Logs->SaveLogs();
	if($_GET['msg'] == 1) {
	echo "Vous vous êtes bien désinscrit de notre site";
	}
	

}else{
	header('Location: /index.php');
} ?>