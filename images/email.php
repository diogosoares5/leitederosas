<?php
require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$Nome = utf8_decode($_POST['Nome']);
$Sobrenome = utf8_decode($_POST['Sobrenome']);
$Email = utf8_decode($_POST['Email']);
$Telefone = utf8_decode($_POST['Telefone']);
$Cidade = utf8_decode($_POST['Cidade']);
$Estado = utf8_decode($_POST['Estado']);
$Assunto = utf8_decode($_POST['Assunto']);
$Mensagem = utf8_decode($_POST['Mensagem']);

$body  = "<h2>Nome</h2><p>$Nome $Sobrenome</p>";
$body .= "<h2>Email</h2><p>$Email</p>";
$body .= "<h2>Telefone</h2><p>$Telefone</p>";
$body .= "<h2>Cidade</h2><p>$Cidade</p>";
$body .= "<h2>Estado</h2><p>$Estado</p>";
$body .= "<h2>Assunto</h2><p>$Assunto</p>";
$body .= "<h2>Mensagem</h2><p>$Mensagem</p>";

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

#DADOS DO SERVIDOR E TIPO DE CONEXAO
//$mail->Host       = "smtp.yourdomain.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "site@outershoes.com.br";  // GMAIL username
$mail->Password   = "alfa1234";            // GMAIL password

#Define o remetente 
$mail->SetFrom("contato@outershoes.com.br", "$Nome $Sobrenome");

# Define os destinatário(s) 
$mail->AddAddress('contato@outershoes.com.br', 'Outer Shoes');

# Define os dados técnicos da Mensagem 
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

# Texto e Assunto 
$mail->Subject  = "Outer Shoes - Contato: $Assunto"; // Assunto da mensagem
$mail->Body = $body;

$enviado = $mail->Send();

$URL = "http://lw135465710450be6650.provisorio.ws";

if ($enviado) {
	
	header("location: ".$URL."/fale-conosco/?msg=ok");
			
	
} else {
	header("location: ".$URL."/fale-conosco/?msg=no");

# echo "Informações do erro: " . $mail->ErrorInfo;
}
?>