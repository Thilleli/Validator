<?php
include_once './class/validator/typeerror.php';
/**
 * Erreur HTML de l'API validator.w3.org
 * @param : type message extrait permeiere et derniere ligne premierer et dernières colones
 * @return : les erreurs de la pages donner
 */
//namespace Error;
class ErrorHTML extends TypeErreur{

	private $message;
	private $extract;
	private $lastLine;
	private $firstLine;
	private $lastColumn;
	private $firstColumn;

	public function __construct(string $type, string $message,  string $extract,  int $lastLine,  int $firstLine, int $lastColumn,  int $firstColumn){

        parent::__construct($type);
		$this->message = $message;
		$this->extract = $extract;
		$this->lastLine = $lastLine;
		$this->firstLine = $firstLine;
		$this->lastColumn = $lastColumn;
		$this->firstColumn = $firstColumn;

	}
	public function GetType(){
			return parent::GetType();
	}

	public function GetMessage(){
			return $this->message;
	}

	public function GetExtract(){
			return $this->extract;
	}
	public function GetLasttLine(){
			return $this->lastLine;
	}

	public function GetFirstLine(){
			return $this->firstLine;
	}

	public function GetLastColumn(){
			return $this->lastColumn;
	}
	public function GetFirstColumn(){
			return $this->firstColumn;
	}
	/*public function Exist(string $DebutMessage, $element, sting $FinMessage)
	{
		if (!empty($element) || $element==NULL) {
			$reponse = $DebutMessage.$element.$FinMessage;
			return $reponse;
		}
	}*/

	public function __toString(){
		$out = "<h3>Erreur dans le code HTML</h3>";
        $out .= parent::__toString();
        //$out .= "<p>Type d'erreur : ". $this->type ."</p>";
        $out .= "<p><b>Message : </b>". $this->message ."</p>";
        if (!empty($this->extract)) {
        $out .= "<p><b>Extrait  : </b><xmp>".$this->extract. "</xmp></p>";
        }
      	if (!empty($this->lastLine)) {
      		$out .= "<p><b>Dernière Ligne :</b> ". $this->lastLine ."</p>" ;// a dernière ligne (incluse) sur laquelle tombe la plage source associée au message.
      	}
      	if (!empty($this->firstLine)) {
      		$out .= "<p><b>Première Ligne :</b> ".$this->firstLine."</p>";//indique la première ligne sur laquelle tombe la plage source associée au message
      	}
      	if (!empty($this->lastColumn)) {
      		$out .= "<p><b>Dernière Colonne :</b> ".$this->lastColumn."</p>";// indique la dernière colonne (incluse) sur laquelle la plage source associée au message tombe sur la dernière ligne sur laquelle se trouve.
      	}
      	if (!empty($this->firstColumn)) {
      		$out .= "<p><b>Première Colonne :</b> ".$this->firstColumn."</p>";// indique la première colonne sur laquelle tombe la plage source associée au message sur la première ligne sur laquelle tombe.*/
      	}
        return $out;
    }

	}

?>
