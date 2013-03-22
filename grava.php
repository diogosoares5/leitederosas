<?php
session_start();
include 'connect.php';
 
$nome = $_POST['nomes'];
$email = $_POST['emails'];
$data = date("j-n-Y");

$s = mysql_query("SELECT * FROM newsletteremails WHERE email_newsletter = '".mysql_real_escape_string($email)."'");

$user = mysql_fetch_object($s);
if(isset($user->id)):
	$_SESSION['flash'] =  "Usuario já cadastrado";
else:
$sql = mysql_query("INSERT INTO newsletteremails (nome_newsletter ,email_newsletter, data) VALUES ('$nome', '$email', '$data')");

if ($sql == 1 ) {
$_SESSION['flash'] =  "Seu cadastro foi realizado com sucesso";

}
elseif ($sql == 0 )
{
$_SESSION['flash'] =  "Não foi bem sucedido";
}
endif;
header('Location: http://www.leitederosas.com.br/index.php#form');
?>