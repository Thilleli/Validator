<?php
include_once './class/validator/typeerror.php';
/**
 * Erreur CSS de l'API validator.w3.org
 * @param : line context type message
 * @return : les erreurs de la pages donner
 */
//namespace Error;
class WarningCSS extends TypeErreur{

	private $line;
	private $message;
	
	public function __construct(int $line, string $type,  string $message){

        parent::__construct($type);
		$this->message = $message;
		$this->line = $line;
	}
	public function GetType(){
			return parent::GetType();
	}

	public function GetMessage(){
			return $this->message;
	}

	public function GetLine(){
			return $this->line;
	}
	public function __toString(){

        $out = "";
        $out  .= parent::__toString();
        $out .= "<p><b>Line :</b> ". $this->line ."</p>";
        $out .= "<p><b>Message :</b> ". $this->message ."</p>";
        
        return $out;
    }

	}

?>
