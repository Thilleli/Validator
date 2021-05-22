<?php
/*

  $url = 'https://waytolearnx.com/2019/07/comment-parcourir-un-tableau-multidimensionnel-en-php.html';
  $parse = parse_url($url);
  echo $parse['host']; 
*/
  //Inclure la classe PHPMailer
// On va chercher la classe PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function smtpmailer($to, $nom, $prenom, $key)
{
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';

	$mail->isSMTP();					// Active l'envoi via SMTP
	$mail->Host = 'smtp.gmail.com';			// Nom du serveur sur lequel vos emails sont hébergés
	$mail->SMTPAuth = true;					// Active l'authentification par SMTP
	$mail->Username = 'noreplysvalidator@gmail.com';			// Nom d'utilisateur SMTP (votre adresse email complète)
	$mail->Password = 'Wasef01*';			// Mot de passe de l'adresse email indiquée précédemment
	$mail->Port = 465;					// Port SMTP
	$mail->SMTPSecure = "ssl";				// Utiliser SSL
	$mail->isHTML(true);					// Format de l'email en HTML

	//Voici ensuite les paramètres liés au mail :

	$mail->From = 'noreplysvalidator@gmail.com';			// L'adresse mail de l'emetteur du mail (en général identique à l'adresse utilisée pour l'authentification SMTP)
	$mail->FromName = 'Validator';				// Le nom de l'emetteur qui s'affichera dans le mail
	$mail->addAddress($to);			// Un premier destinataire
	//$mail->addAddress('ellen@example.com');			// Un second destifataire (facultatif)
								// Possibilité de répliquer la ligne pour plus de destinataires
	//$mail->addReplyTo('contact@azertyfrance.fr');			// Pour ajouter l'adresse à laquelle répondre (en général celle de la personne ayant rempli le formulaire)
	//$mail->addCC('cc@example.com');				// Pour ajouter un champ Cc
	//$mail->addBCC('bcc@example.com');			// Pour ajouter un champ Cci
	$heure = date('H')+1;
	$date = date('Y-m-d|'.$heure.':i:s');
	$sujet = 'Bienvenue sur Validator';
	$body = 'Bonjour '.$nom.' '.$prenom.', <br> Nous sommes heureux de te voir parmi nous! Pour commencer tu dois confirmer ton compte. Cliques juste sur le lien&nbsp;ci-dessous. Attention ! ce lien expire le '.$date.'<br>
	Lien : https://validator.alwaysdata.net/validecompte.php?key='.$key.'&date='.$date;'<br>
	Si tu as des questions, reponds juste à ce mail—On sera heureux de te répondre.<br>
	A très bientôt,<br>
	L\'équipe Validator.';

	$mail->Subject = $sujet;			// Le sujet de l'email
	$mail->Body    = $body;		// Le contenu du mail en HTML
	$mail->AltBody = $body;	// Le contenu du mail au format texte
	if(!$mail->Send())
	{
		$error ="Erreur...";
		return $error;
	}
	else
	{
		$error = "Merci. Votre message a été bien envoyé.";
		return $error;
	}
}
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
	  	<link rel="stylesheet" type="text/css" href="style/style.css">
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</head>
	<body>
	<h1>Validator</h1>

	
	';
	if (!empty($_SESSION['id_user'])) {
		$header.= '<ul>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="pageProfile.php">Profil</a></li>
		<li><a href="Apropos.php">À propos</a></li>
		<li style="float:right"><a href="deconnexion.php">Déconnexion</a></li>
		<li style="float:right"><a href="delet_user.php">Me désinscrire</a></li>
		</ul><div id="bodyofbody">';
	}
	else{
		$header.=  '<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="Apropos.php">À propos</a></li>
			<li><a href="#contact">Contact</a></li>
			<li style="float:right"><a href="connexion.php">Connexion</a></li>
			<li style="float:right"><a href="inscription.php">Inscription</a></li>
		</ul><div id="bodyofbody">';
	}
	
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
	<br>
	<div style="text-align : center;">
    <input  type="checkbox" id="warning" name="warning">   <label for="warning" style="font-size : 12px;">  Afficher les avertissements du code CSS</label>
    <br>
     <input type="hidden" name="formtype" value="validator" /> 
     <input  type="submit" value="Valider" id="ButtonValid"/>
     </div>
	</form>';

	return $form;
}

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
function InsertUser($nom,$prenom,$email,$tel,$login,$password,$key){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le login n'existe pas 
	$request =  ("INSERT INTO `user`(id_user,nom_user,prenom_user,mail_user,tel_user,login_user,mdp_user,key_chiffrement)
              VALUES (NULL,'$nom', '$prenom','$email' ,'$tel','$login','$password','$key')");
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

//fonction qui genere une clé aleatoire
function random_key($length=20){
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $string = '';
  for($i=0; $i<$length; $i++){
      $string .= $chars[rand(0, strlen($chars)-1)];
  }
  return $string;
}

function verifkey($key){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request =  ("SELECT count(*) FROM user WHERE key_chiffrement='$key'");
	$verification = $ConnexionBDD->getResults($conn,$request);
	while ($row = $verification -> fetch_array(MYSQLI_NUM)) {
		if($row[0] == 1){
			return True;
		}
	}
}
function CompteReady($key){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request =  ("UPDATE user SET compte_valide = 1 WHERE key_chiffrement='$key'");
	$verification = $ConnexionBDD->getResults($conn,$request);
	if($verification){
		return True;
	}
}
function DeleteCompte($key){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request =  ("DELETE FROM user WHERE key_chiffrement='$key'");
	$verification = $ConnexionBDD->getResults($conn,$request);
	if($verification){
		return True;
	}
}
function DeleteUser($session){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request=("DELETE FROM user WHERE id_user='$session'");
	$verification = $ConnexionBDD->getResults($conn,$request);
	if($verification){
		return True;
	}
}
function user_validated($login,$password){

	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	 
	$request=("SELECT compte_valide FROM user WHERE login_user='$login' AND mdp_user='$password'");
	$result = $ConnexionBDD->getResults($conn,$request);
	while ($row = $result -> fetch_array(MYSQLI_NUM)) {
		if($row[0]==1){
			return True;
		}
	}
}
function Historique($id_user,$url,$date){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le login n'existe pas 
	$request =  ("INSERT INTO `historique`(id_historique,id_user,lien,`date`)
              VALUES (NULL,'$id_user','$url','$date')");
	$insert = $ConnexionBDD->getResults($conn,$request);
	if($insert){
		return TRUE;
	}
}
function SeeHistorique($id_user){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le mail entre n'existe pas dans la base de données 
	$request_mail = ("SELECT date,lien FROM historique WHERE id_user='$id_user'");
	$verification_mail = $ConnexionBDD->getResults($conn,$request_mail);
	while ($row = $verification_mail -> fetch_array(MYSQLI_NUM)) {
		 for ($i=0; $i <sizeof($row) ; $i++) { 
		 	if ($i%2) {
		 		echo $row[$i].'	 <br><br>';
		 	}
		 	else{
		 		echo '<code>'.$row[$i].'</code> &nbsp;&nbsp;&nbsp;&nbsp;';
		 	}
			
		}
	}
}
function DeleteHistorique($id_user){
	$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
	$conn = $ConnexionBDD->OpenCon();
	// Verifie que le login n'existe pas 
	$request =  ("DELETE FROM `historique` WHERE id_user='$id_user'");
	$delete = $ConnexionBDD->getResults($conn,$request);
	if($delete){
		return TRUE;
	}
}
?>