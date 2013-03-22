<?php

/**
 * Classe para validação de dados
 * author faael
 * copyright 2008
 */

class validacao {
	var $campo;
	var $valor;
	var $msg = array();
	
	// Mensagens de erro
	function mensagens($num, $campo, $max, $min) {		
		$this->msg[0] = "Preencha o campo com um email válido <br />"; // EMAIL		
		$this->msg[1] = "Preencha o campo ".$campo." com numeros <br />"; // APENAS NUMEROS		
		$this->msg[2] = "Preencha o campo ".$campo." <br />"; // CAMPO VAZIO
		$this->msg[3] = "O ".$campo." deve ter no máximo ".$max." caracteres <br />"; // MÁXIMO DE CARACTERES
		$this->msg[4] = "O ".$campo." deve ter no mínimo ".$min." caracteres <br />"; // MÍNIMO DE CARACTERES
		
		return $this->msg[$num];
	}
	
	// Validar Email
	function validarEmail($email) {
		if(!eregi("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$", $email)){
			return $this->mensagens(0, 'email', null, null);
		}
	}	
   		
	// Validar Numero
	function validarNumero($campo,$numero) {
		if(!is_numeric($numero)) {
			return $this->mensagens(6, $campo, null, null);
		}
	}
	
	// Verificação simples (Campo vazio, maximo/minimo de caracteres)
	function validarCampo($campo, $valor, $max, $min) {
		$this->campo = $campo;
			if ($valor == "") {
				return $this->mensagens(8, $campo, $max, $min);
			} 
			elseif (strlen($valor) > $max) {
				return $this->mensagens(9, $campo, $max, $min);
			} 
			elseif (strlen($valor) < $min) {
				return $this->mensagens(10, $campo, $max, $min);	
			}
	}	
	
	// Verifica se há erros
	function verifica() {
		if (sizeof($this->msg) == 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>