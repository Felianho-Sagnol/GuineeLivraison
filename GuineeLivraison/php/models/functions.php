<?php 
    //require_once("db.php");

    function verif_password($password){
		if(preg_match('#^[a-zA-Z0-9]+$#',$password) AND strlen($password) >= 6)
			return true;
		return false;
	}

	// fonction verifiant si un utilisateur a donné un bon nom ou un bon prenom
	function verif_name($name){
		if(preg_match('#^[a-zA-Zé\'"êâäîôûçàµ£$]{1,}[a-zA-Z._ -é\'"êâäîôûçàµ£$]*$#',$name) AND strlen($name) >= 2)
			return true;
		return false;
	}

	//fonction verfiant si un numero de phone est correcte.
	function verif_phone($phone){
		if(preg_match('#^(\+[0-9]{1,5})?[0-9]{6,}$#',$phone))
			return true;
		return false;
	}

    //fonction verfiant si un numero de phone est correcte.
	function verif_code($code){
		if(preg_match('#^[a-zA-Z0-9-_.+]{6,}$#',$code))
			return true;
		return false;
	}

    function generationCodeParrain(){
        $code ="BP-";
	    for($i=0;$i<4;$i++){
			$code .= mt_rand(0,9);
		}
        $code .= "-";
        for($i=0;$i<3;$i++){
			$code .= strtoUpper(chr(rand(97,122)));
		}
        return $code;
    }
	function verif_code_promo($code){
		if(preg_match('#^BP-[0-9]{4}-[A-Z]{3}$#',$code))
			return true;
		return false;
	}



