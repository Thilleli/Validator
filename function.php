<?php
/*

  $url = 'https://waytolearnx.com/2019/07/comment-parcourir-un-tableau-multidimensionnel-en-php.html';
  $parse = parse_url($url);
  echo $parse['host']; 
*/
function getTabUrl($url){
  $parse = parse_url($url); 
	$taburl = [];
	$pattern = '#(?:href|path|xmlns(?::xsl)?)\s*=\s*(?:"|\')\s*(.+)?\s*(?:"|\')#Ui';
	$subject = file_get_contents($url);
	preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);

	$nombre = count($matches[1]);
	array_push($taburl,$url);//ajoute l'url sélctionner dans le tableau

	foreach($matches[1] as $match)
	{
		$parse2 = parse_url($match);
		if ($parse2['host'] == '') {
			$lastChar = substr($url, -1);
			if ($lastChar =='/') {
				$urls = $url;
			}
			else{
				$urls = $url.'/';
			}
		}
		else{
			$urls = '';
		}
		
		$urls .= $match;
		$parse3 = parse_url($urls);
		if (!in_array($urls, $taburl)) {//si le lien n'xiste pas déja
			if ($parse3['host']==$parse['host']) {//verifie que le nom d'hote sont les même pour pas tomber sur des pages qui n'ont pas le meme nom de domain
				array_push($taburl,$urls); //ajoute les urls rejoint sur la page 
			}
		}
		$urls ='';
	}
	//var_dump($taburl);
	return $taburl;
}

function CountTabUrl($url){
	$taburl = getTabUrl($url);
	$count = count($taburl);
	return $count;
}
function CheckValue($value){
	if ($value == NULL) {
		$value = 0;
		return $value;
	}
	else{
		return $value;
	}
}
function NoError($error)
{
	if ($error == 0) {
		$message = '<div class = "container"> PAS D\'ERREUR </div>';
	}
	return $message;
}

function Nav($title){
	$header='
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<title>'.$title.'</title>
		<meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="/style/style.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<h1>Validator</h1>

	<ul>
	  <li><a href="index.php">Accueil</a></li>
	  <li><a href="#propos">À propos</a></li>
	  <li><a href="#contact">Contact</a></li>
	  <li style="float:right"><a href="connexion.php">Connexion</a></li>
	  <li style="float:right"><a href="inscription.php">Inscription</a></li>
	</ul><div id="bodyofbody">';
	return $header;
}
function Footer(){
	$footer='</div>
	<footer><p>© 2021 - WASEF Alexandra & BELHOCINE Thilleli</p></footer>
	
	</body>
	</html>
	';
	return $footer;
}

function FormValidator(){
	$form = '<form action="index.php" method="post">
	<h2>Valide ton site</h2>
	<label>Entrez l\'url de votre site :</label>
    <input type="text" placeholder="https://example.com" name="url" id="url" required/> 
     <input type="hidden" name="formtype" value="validator" /> 
     <input type="submit" value="Valider" id="ButtonValid"/>
	</form>';

	return $form;
}
/*function NavBootstrap($title){
	$header='
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<title>'.$title.'</title>
		<meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="/style/style.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style>
  		.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited 
  		{
   			 background-color: #8064A2 !important;
   		}
   		.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited 
  		{
   			 border-color: green !important;
   		}

    	 .btn-primary:active 
    	{
   		 	 background-color: yellow !important;
		}
		ul, li, a {
			list-style: none;
		}
	</style>
	</head>
	<body>
	<h1>Validator</h1>

	<ul>
	  <li><a href="index.php">Accueil</a></li>
	  <li><a href="#propos">À propos</a></li>
	  <li><a href="#contact">Contact</a></li>
	  <li style="float:right"><a href="connexion.php">Connexion</a></li>
	  <li style="float:right"><a href="inscription.php">Inscription</a></li>
	</ul><div id="bodyofbody">';
	return $header;
}*/
function FormInscription(){
	$form = '<form action="inscription.php" method="post" >
		<div class="container ">

			<h2> Inscription <h2>
			<div class="form-row">
				<div class="col-md-6">
					<label for="nom"> Nom : </label>
					<input type="nom" name="nom" id="nom" class="form-control" placeholder="Smith" required>
				</div>
			
				<div class="col-md-6">
					<label for="prenom"> Prenom : </label>
					<input type="prenom" name="prenom" id="prenom" class="form-control" placeholder="Jean" required >
				</div>
			</div>


			<div class="form-row">
				<div class="col-md-6">
					<label for="email"> E-mail : </label>
					<input type="email" name="email" id="email" class="form-control" placeholder="nom@exemple.com" required> 
				</div>
			
				<div class="col-md-6">
					<label for="tel"> Télephone : </label>
					<input type="tel" name="tel" id="tel" class="form-control" placeholder="06 23 56 84 12 (optionel)" >
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-6">
					<label for="login"> Login : </label>
					<input type="login" name="login" id="login" class="form-control" placeholder="NomPrenom75" required> 
				</div>
			
				<div class="col-md-6">
					<label for="password"> Mot de passe : </label>
					<input type="password" name="password" id="password" class="form-control" placeholder="6 caratère minimum" required>
				</div>
			</div>

			<input type="hidden" name="formtype" value="inscription" /> 
			<div class="col text-center">
				<button type="submit" class="btn btn-primary color-99CC5B">Envoyer</button>
			</div>
		</div>
	</form>';

	return $form;
}



function MailExist($mail){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le mail entre n'existe pas dans la base de données 
	$request_mail = ("SELECT COUNT(*) mail_user FROM user WHERE mail_user='$mail'");
	$verification_mail = $ConnexionBDD->getResults($conn,$request_mail);
	while ($row = $verification_mail -> fetch_array(MYSQLI_NUM)) {
		 for ($i=0; $i <sizeof($row) ; $i++) { 
			if ($row[0]==1) {
				return $MailExist= TRUE;
			}
			else{
				return false;
			}
			
		}
	}
}
// Verifier si le login n'existe pas dans la bdd 
function LoginExist($login){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le login n'existe pas 
	$request_login =  ("SELECT COUNT(*) login_user FROM user WHERE login_user='$login'");
	$verification_login = $ConnexionBDD->getResults($conn,$request_login);
	 while ($row = $verification_login -> fetch_array(MYSQLI_NUM)) {
		 for ($i=0; $i <sizeof($row) ; $i++) { 
			if ($row[0]==1) {
				return $LoginExist = TRUE;
			}
			else{
				return false;
			}
		}
	}
}


// function qui insère les données du user dans la bdd
function InsertUser($nom,$prenom,$email,$tel,$login,$password){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le login n'existe pas 
	$request =  ("INSERT INTO `user`(id_user,nom_user,prenom_user,mail_user,tel_user,login_user,mdp_user)
              VALUES (NULL,'$nom', '$prenom','$email' ,'$tel','$login','$password')");
	$verification = $ConnexionBDD->getResults($conn,$request);
	if($verification){
		return TRUE;
	}
}

// function qui vérifie si l'utilisateur est bien inscris
function verifUser($login,$password){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request =  ("SELECT count(*) FROM user WHERE login_user='$login' AND mdp_user='$password'");
	$verification = $ConnexionBDD->getResults($conn,$request);
	while ($row = $verification -> fetch_array(MYSQLI_NUM)) {
		if($row[0] == 1){
			return TRUE;
		}
	}

}


?>