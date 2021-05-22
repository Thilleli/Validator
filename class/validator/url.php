<?php

/**
 * URL
 * @param : URL du site à corriger
 * @return : le nom de l'url les API avec l'url entré
 */

class URLS{

	private $url;

	public function __construct( $url){

		$this->url = $url;

	}
	public function GetURL(){
			return $this->url;
	}

	public function GetURLValidatorHTML(){
		$urlValid = "https://validator.w3.org/nu/?doc=".$this->url."&out=json";
		return $urlValid;
	}
	public function GetURLValidatorCSS(){
		$urlValid = "https://jigsaw.w3.org/css-validator/validator?uri=".$this->url."&output=json";
		return $urlValid;
	}
	public function ValideURL(){//verifie que le lien n'est pas une image
		$url = $this->url;
		if (!preg_match('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)([^\s]+(\.(?i)(jpg|png|gif|bmp|ico|html#v14))$)@',$url)) {
			if (!preg_match("/#/", $url)) {
				if (!preg_match("/@/", $url))
					{
						if (!preg_match("/.css/", $url))
						{
							return True;
						}
						else{
							return False;
						}
					}
				else{
						return False;
					}
			}
			else
			{
				return False;
			}
		}
		else{
			return False;
		}
	}

	public function __toString(){
	    $out  = "<------------------URL-----------------><br>";
	    $out .= "<p> URL : ". $this->url ."</p>";
	    return $out;
    }

}

?>
