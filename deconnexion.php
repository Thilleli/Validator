<?php 
include_once './class/bdd/connexionbdd.php';
include_once './class/logs/logs.php';
	$Logs=New Logs('à été déconnecter');
	$Logs->SaveLogs();
	$_SESSION = array();
	session_destroy();
	header('Location: connexion.php');
exit();
	
?>

