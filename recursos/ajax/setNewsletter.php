<?php 
include_once "config.php";

header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Define variáveis
$msg = null;

$varNome  = isset($_POST["txtNome"]) ? $_POST["txtNome"] : "";
$varEmail  = isset($_POST["txtEmail"]) ? $_POST["txtEmail"] : "";


if (trim($varNome == "")) {
        $msg = "-> O campo \"Nome\" deve ser preechido ! <br>";
} else if (trim($varEmail == "")) {
        $msg = "-> O campo \"E-mail\" deve ser preechido ! <br>";
}  else {
        
        // Cadastra cliente
        $query  = ("INSERT INTO newsletteremails(nome_newsletter,email_newsletter) VALUES('$varNome','$varEmail')");
        $result = mysql_query($query);
        
        if($result)
  $msg = 1;
        else
  $msg = "Erro ao cadastrar cliente !<br>".mysql_error();
}

if(isset($msg)) {
        echo utf8_encode($msg);
}

?>