<?php
//include_once 'url.php';
/**
 * Erreur HTML de l'API validator.w3.org
 * @param : type  d'erreur 
 * @return : : erreur,info...
 */
class TypeErreur{

	private $type;

	public function __construct(string $type){	
		$this->type = $type;

	}
	public function GetType(){
			return $this->type;
	}

	public function __toString(){
        $out  = "";
        $out .= "<p> <b>Type : </b>". $this->type ."</p>";
        return $out;
    }

}

?>
