<?php

//$configs = include('login_bdd.php');
//$config = include('login_bdd_cinemaneverland_bdd.php');
//----------------------------------------------------------------------------------------
/**
 * URL
 * @param : information à la base de donner (servername, dbname, username,password)
 * @return : une connexion a la bdd
 */

class ConnexionBDD{

	private $servername;
	private $dbname;
	private $username;
	private $password;

	public function __construct( string $servername, string $dbname, string $username, string $password){

		$this->servername = $servername;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;

	}
	public function ServerName(){
			return $this->servername;
	}
	public function DBName(){
			return $this->dbname;
	}
	public function UserName(){
			return $this->username;
	}
	public function Password(){
			return $this->password;
	}
	public function OpenCon()
	{
		$conn = mysqli_connect($this->servername, $this->username, $this->password,$this->dbname);
		if (!$conn){
			error_log("Connect failed");
		}
		$conn->set_charset('utf8');
 
		return $conn;
	}
	public function CloseCon($conn)
	{
		$conn -> close();
	}

	public function getResults($connexion,$request)
	 {

	    //Connexion à la base de données
	     $conn = $connexion;

	     $result = mysqli_query($conn,$request);
	     //fermeture de la connexion
	     
	     return $result;
	     $conn -> close();
	 }

	public function __toString(){
	    $out  = "<------------------Connxion à la BDD-----------------><br>";
	    $out .= "<p> ServerName : ".$this->servername ."</p>";
	    $out .= "<p> DBName : ".$this->dbname."</p>";
	    $out .= "<p> UserName : ".$this->username."</p>";
	    $out .= "<p> Password : ".$this->password."</p>";
	    return $out;
    }

}


?>
