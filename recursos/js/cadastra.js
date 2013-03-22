// Cadastra os dados do usuário no banco

function cadastraUsuario()
{		
	//$( '.listadeeventos' ).html( IMAGE_LOADER );

		nome = $( '#nome_newsletter' ).val();
		email = $( '#email_newsletter' ).val();
	
		$.ajax({
		  type: 'POST',
		  //url: $(this).attr( 'href' ),
		  url: TEMPLATE_URL + 'recursos/ajax/setNewsletter.php',
		  data: { nome: nome, email: email },
		  success: function( results ) {
			
			if(results == "<span class='green'>Enviado com sucesso!</span>")
			{
				$( '#nome_newsletter' ).val('');
				$( '#email_newsletter' ).val('');
			}
			
			$('.response_news .response').html(results)
			
			$('.response_news').fadeIn('fast');
			
			setTimeout(function(){
				$('.response_news').fadeOut('fast');
			}, 3000);
			
			//adiciona valores nos inputs depois da exibição do resultado
			$('#nome_newsletter').val("Nome");
			$('#email_newsletter').val("E-mail");
		  }
		});

}