<?php
include_once './class/validator/typeerror.php';
include_once './class/validator/warningcss.php';

/**
 * Erreur CSS de l'API validator.w3.org
 * @param : line context type message
 * @return : les erreurs de la pages donner
 */
//namespace Error;
class ErrorCSS extends WarningCSS{
	
	private $context;

	public function __construct(int $line, string $context , string $type,  string $message){

        parent::__construct($line, $type,$message);
		$this->context = $context;
	}

	public function GetContext(){
			return $this->context;
	}
	public function GetType(){
			return parent::GetType();
	}

	public function GetMessage(){
			return parent::GetMessage();
	}

	public function GetLine(){
			return parent::GetLine();
	}

	public function __toString(){

        $out = parent::__toString();
        $out .= "<p><b>Context : </b> <code> ". $this->context ."</code></p>";
        
        return $out;
    }

	}

?>
