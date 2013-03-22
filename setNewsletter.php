<?php 
include_once "config.php";

header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Define variáveis
$msg = null;

$varNome  = isset($_POST["nomes"]) ? $_POST["nomes"] : "";
$varEmail  = isset($_POST["emails"]) ? $_POST["emails"] : "";


if (trim($varNome == "" || $varEmail == "Digite seu nome")) {
        $msg = "-> O campo Nome deve ser preechido ! <br>";
} else if (trim($varEmail == "" || $varEmail == "Digite seu e-mail")) {
        $msg = "-> O campo \"E-mail\" deve ser preechido ! <br>";
}  else {
        
        // Cadastra cliente
        $query  = ("INSERT INTO newsletteremails(nome_newsletter,email_newsletter) VALUES('$varNome','$varEmail')");
        $result = mysql_query($query);
        
        if($result){
  $msg = 1;}
        else{
  $msg = "Erro ao cadastrar cliente !<br>".mysql_error();}
}

if(isset($msg)) {
        echo utf8_encode($msg);
}

?>