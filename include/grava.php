<?php
session_start();
$conexao = mysql_connect("mysql01.bighost.com.br","root","")
or die("Cofiguração de Banco de Dados Errada");
$db = mysql_select_db("leitede_p1lrw ",$conexao)
or die("Cofiguração de Banco de Dados Errada");

 
$nome = $_POST['nomes'];
$email = $_POST['emails'];

$s = mysql_query("SELECT * FROM newsletteremails WHERE email_newsletter = '".mysql_real_escape_string($email)."'");

$user = mysql_fetch_object($s);
if(isset($user->id)):
	$_SESSION['flash'] =  "Usuario já cadastrado";
else:
$sql = mysql_query("INSERT INTO  newsletteremails (nome_newsletter  ,email_newsletter) VALUES ('$nome',  '$email')");

if ($sql == 1 ) {
$_SESSION['flash'] =  "Seu cadastro foi realizado com sucesso";

}
elseif ($sql == 0 )
{
$_SESSION['flash'] =  "Não foi bem sucedido";
}
endif;
header('Location: http://www.leitederosas/index.php#form');
?>