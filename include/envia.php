<?php 
session_start();

$email_destino = "faleconosco@lr.com.br";
if( isset( $_POST['nome']) && isset( $_POST['email']) && isset( $_POST['estado']) && isset( $_POST['cidade']) && isset( $_POST['mensagem']))
	{
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$estado = $_POST['estado'];
	$municipio = $_POST['cidade'];
	$sugestao = $_POST['mensagem'];
	
		$mensagem = "<b>$nome</b><br/>";
		$mensagem .= "$email <br/>";
		$mensagem .= "$estado <br/>";
		$mensagem .= "$municipio <br/>";
		$mensagem .= "$sugestao\n";
		
				include("class.phpmailer.php");
				include("class.smtp.php");
				
				$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

				$mail->IsSMTP(); // telling the class to use SMTP
				
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.lr.com.br";      // sets GMAIL as the SMTP server
				$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "noreply@lr.com.br";  // GMAIL username
				$mail->Password   = "Rel09501";            // GMAIL password
				#Define o remetente
				$mail->SetFrom("noreply@lr.com.br", "noreply@lr.com.br");	
				$mail->CharSet = 'utf-8';
				# Define os destinatário(s) 
				$mail->AddAddress('faleconosco@lr.com.br', 'Leite de Rosas');
				
				# Define os dados técnicos da Mensagem 
				$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			
				$mail->Subject  = "sugestão do usuario "; // Assunto da mensagem
				$mail->Body = $mensagem;
				
				$envia = $mail->Send();				
				
				if($envia):
					$_SESSION['flash1'] = "Sua mensagem enviada com sucesso!";
				else:
					$_SESSION['flash1'] = "Erro testen ";
					
				endif;
	}else{
				$_SESSION['flash1'] = "todos os campos devem ser preenchidos!";
		
		}
				header('Location: http://www.leitederosas/index.php#form');
						
?>
