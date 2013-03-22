<?php
require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$Nome = $_POST['Nome'];
$Sobrenome = $_POST['Sobrenome'];
$Email = $_POST['Email'];
$Telefone = $_POST['Telefone'];
$Cidade = $_POST['Cidade'];
$Estado = $_POST['Estado'];
$Assunto = $_POST['Assunto'];
$Mensagem = $_POST['Mensagem'];

$body  = "<h2>Nome</h2><p>$Nome $Sobrenome</p>";
$body .= "<h2>Email</h2><p>$Email</p>";
$body .= "<h2>Telefone</h2><p>$Telefone</p>";
$body .= "<h2>Cidade</h2><p>$Cidade</p>";
$body .= "<h2>Estado</h2><p>$Estado</p>";
$body .= "<h2>Assunto</h2><p>$Assunto</p>";
$body .= "<h2>Mensagem</h2><p>$Mensagem</p>";

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "smtp.gmail.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "carneironline@gmail.com";  // GMAIL username
  $mail->Password   = "gtartgmail";            // GMAIL password
  $mail->AddReplyTo('carneironline@gmail.com', "$Nome $Sobrenome");
  $mail->AddAddress('carneironline@gmail.com', 'Outer Shoes');
  $mail->SetFrom('contato@outershoes.com.br', "$Nome $Sobrenome");
  $mail->AddReplyTo('carneironline@gmail.com', "$Nome $Sobrenome");
  $mail->Subject = 'Outer Shoes - Contato: '.$Assunto;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  $mail->Send();
 
  echo '<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'?msg=ok";</script>' ;

} catch (phpmailerException $e) {
  //echo $e->errorMessage(); //Pretty error messages from PHPMailer
  echo '<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'?msg=no";</script>' ;
} catch (Exception $e) {
  //echo $e->getMessage(); //Boring error messages from anything else!
  echo '<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'?msg=no";</script>' ;
}
?>