<?php 
session_start();

$email_destino = "diogosoliv5@gmail.com";
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
				$mail->Host       = "mail.live.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "diogosoliv5@hotmail.com";  // GMAIL username
				$mail->Password   = "FlaMengo25";            // GMAIL password
				#Define o remetente
				$mail->SetFrom("diogosoliv5@hotmail.com", "teste");	
				$mail->CharSet = 'utf-8';
				# Define os destinatário(s) 
				$mail->AddAddress('diogosoliv5@gmail.com', 'Diogo');
				
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
				header('Location: http://web.dizain.com.br:81/leitederosas/index.php#form');
						
?>
