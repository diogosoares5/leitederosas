if(location.host == 'localhost')
{
	var SITE_URL = '/OuterShoes_TEMP/#/';
	var TEMPLATE_URL = '/OuterShoes_TEMP/wp-content/themes/outer_tpl1/';
} else {
	var SITE_URL = '/';
	var TEMPLATE_URL = '/wp-content/themes/outer_tpl1/';
}

var IMAGE_LOADER = '<img style="display:block; width:32px; height:32px;" class="imageLoader" src="' + TEMPLATE_URL + 'images/lightbox-ico-loading.gif" />';

// Meses do ano em array
var meses = new Array(12);

meses['01'] = 'Janeiro';
meses['02'] = 'Fevereiro';
meses['03'] = 'Março';
meses['04'] = 'Abril';
meses['05'] = 'Maio';
meses['06'] = 'Junho';
meses['07'] = 'Julho';
meses['08'] = 'Agosto';
meses['09'] = 'Setembro';
meses['10'] = 'Outubro';
meses['11'] = 'Novembro';
meses['12'] = 'Dezembro';


jQuery(document).ready(function(){
	
	var current_url = window.location.href;
	
	if(current_url.indexOf('jardimurbano') > -1 || current_url.indexOf('jardim-urbano') > -1 || current_url.indexOf('?s=') > -1) { 
		jQuery("#n3s_mp3player").hide();		
	}else{
		jQuery("#n3s_mp3player").show();	
	}
	
	
	//$(".rss").click(function(){
//		window.open(SITE_URL+'feed.xml'); 						 
//	});
	
	jQuery('#lojas_list li a').click(function(){
		var nome = $(this).attr('nome');
		var src = $(this).attr('name');
		$("#boxOverlay").fadeIn();
		$("#boxContent").html('<img src="'+src+'" alt="'+nome+'"/>');
		$("#boxInfo").html(nome);
		$("#boxWrap").show();
	});
	jQuery("#boxClose").click(function(){
		closeBox();									   
	});
	$("#boxOverlay").click(function(){
		closeBox();							   
	});
	function closeBox(){
		$("#boxOverlay").fadeOut();
		$("#boxContent").html('');
		$("#boxInfo").html('');
		$("#boxWrap").fadeOut();
	}
	// Ativa o zoom na imagem destaquee
	jQuery(".List-Coletion li").hover(
		function()
		{
			jQuery("span", this).slideDown("fast");	
		},
		function()
		{
			jQuery("span", this).slideUp("fast");	
		}
	);
	$("#featured > .ui-tabs-nav").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	jQuery('#boxImageZoom').zoom({
		url: jQuery('#boxImageZoom img').attr('zoom')
	});

	// Ao fazer o hover nos thumbs, altera a imagem destaque
	jQuery('.variations img').live('click', function(){
		jQuery('#boxImageZoom img').attr({ 
          src: jQuery(this).attr('thumb'),
        });
		jQuery('#boxImageZoom img.zoomImg').attr({ 
          src: jQuery(this).attr('full'),
        });
	});
	
	jQuery('.variations li').click(function(){
		jQuery('.variations li').removeClass('ativo');
		jQuery(this).addClass('ativo');
	});
	
	// Chama o metodo ajax para mudar a cor do produto
	/*jQuery('#single_product_page_container .variations img').click(function()
	{
		getProductVariation(jQuery(this), 'produtos');
	});
	
	jQuery('.wpsc_default_product_list .variations img').hover(function()
	{
		getProductVariation(jQuery(this), 'produtos');
	});*/
	
	
	
//var vl = $('#n3s_body').html();
//	if(vl == ''){
//		jQuery("#n3s_mp3player").hide();
//		$.ajax({
//			url: TEMPLATE_URL +'404.php',
//			success:function(result){
//				$('#Wrap').addClass('Error');
//				$('#n3s_body').html(result);	
//			}
//		});
//	}

});

/* METODOS AJAX */
// Modifica o produto chamando sua variação
function getProductVariation(pImage, page)
{
	//$('#lista_noticias_novo').html ( "<h2>Carregando ...</h2>" )
	
	//SINGLE
	if(page=='single')
	{
		// Troca o destaque
		jQuery.ajax({
		  type: 'POST',
		  //url: $(this).attr( 'href' ),
		  url: TEMPLATE_URL + 'functions/ajax/getProductVariation.php',
		  data: { pID: pImage, tipo: 'destaque' },
		  success: function( results ) {		
				jQuery('#boxImageZoom').html ( results );
		  }
		});	
		
		// Troca os thumbnails
		jQuery.ajax({
		  type: 'POST',
		  //url: $(this).attr( 'href' ),
		  url: TEMPLATE_URL + 'functions/ajax/getProductVariation.php',
		  data: { pID: pImage, tipo: 'thumbs', page: page },
		  success: function( results ) {		
				jQuery('.another-images').html ( results );
		  }
		});	
	} 
	//PAGE PRODUTOS
	else 
	{
		jQuery('.wpsc_default_product_list #p' + pImage.attr('parent') +' .wpsc_product_title img').css('display', 'none');
		
		jQuery('.wpsc_default_product_list #p' + pImage.attr('parent') +' .wpsc_product_title img').each(function (i) {
			if (jQuery(this).attr('data-ref')== pImage.attr('data-ref')) {
			  jQuery(this).css('display','block');
			}
		});
		
		
	
	}
}

// Cadastra os dados do usuário no banco

function cadastraUsuario()
{		
	//$( '.listadeeventos' ).html( IMAGE_LOADER );

		nome = $( '#nome_newsletter' ).val();
		email = $( '#email_newsletter' ).val();
	
		$.ajax({
		  type: 'POST',
		  //url: $(this).attr( 'href' ),
		  url: TEMPLATE_URL + 'functions/ajax/setNewsletter.php',
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

// BOX ARQUIVOS CHANGE
jQuery(function($){ 
	jQuery('#arquivos').change(function(){
		if( jQuery(this).val() != '')
		{
			location.href = jQuery(this).val();	
		}
	})
});

// Acrescenta mais uma empresa no cadastro de experiencias profissionais
jQuery(function()
{
	jQuery('.One-More').bind('click', function()
	{
		quantEmpresas = $("#formTrabalheConosco").find("ul.empresa").size();
		
		jQuery.ajax({
		  type: 'POST',
		  //url: $(this).attr( 'href' ),
		  url: TEMPLATE_URL + 'functions/ajax/maisEmpresa.php',
		  data: { empresa_numero: quantEmpresas  },
		  success: function( results ) {		
				$(results).insertAfter( jQuery('ul.empresa:last') );
		  }
		});	
	});
	
	// remove a classe ERROR dos inputs dos forms
	jQuery('.form input').bind('click', function()
	{
		jQuery(this).removeClass('error');
	});
	// remove a classe ERROR dos inputs dos forms
	jQuery('.form input').bind('focus', function()
	{
		jQuery(this).removeClass('error');
	});
	
	// remove a ul.empresa PAI do item
	jQuery('.removeEmpresa').live('click', function()
	{
		jQuery(this).parent().parent().remove();
	});
	
	// Escreve i nome da imagem carregada na label Fake
	jQuery('#file-original').live('change', function()
	{
		jQuery('.FkLabel').html( jQuery(this).val() );
	});
	
	// Gera o click na div inteira de lojas na HOME
	jQuery('#featured div').click(function(){
		location.href = SITE_URL + 'lojas';	
	});
	
	// Pega o item das MIDIAS SOCIAIS pelo click
	$('.midias-compartilhar li img').click(function(){
		midiaTitle = $(this).attr('midiaTitle');
		midiaUrl = $(this).attr('midiaUrl'); 
		midiaImage = $(this).attr('midiaImage'); 
		midiaCaption = $(this).attr('midiaCaption');
		midiaDescription = $(this).attr('midiaDescription');

		switch($(this).attr('alt'))
		{
			case 'Facebook': window.open('https://www.facebook.com/dialog/feed?app_id=324223904344886&link='+midiaUrl+'&picture='+midiaImage+'&name='+midiaTitle+'&caption='+midiaCaption+'&description='+midiaDescription+'&redirect_uri=http://facebook.com/&display=popup', 'Facebook', 'width=400, height=400'); break;
			case 'Twitter' : window.open('https://twitter.com/intent/tweet?text=' + midiaTitle + '&url=' + midiaUrl, 'Twitter', 'width=600, height=400'); break;
			case 'Pinterest' : window.open('http://pinterest.com/pin/create/button/?url=' + midiaUrl + '&media=' + midiaImage+ '&description=' +midiaTitle, 'Twitter', 'width=600, height=400'); break;
		}
	});
	
	// Pega o item das MIDIAS SOCIAIS pelo click
	$('.Share li img').click(function(){
		midiaTitle = $(this).attr('midiaTitle');
		midiaUrl = $(this).attr('midiaUrl'); 
		midiaImage = $(this).attr('midiaImage'); 
		midiaCaption = $(this).attr('midiaCaption');
		midiaDescription = $(this).attr('midiaDescription');


		switch($(this).attr('alt'))
		{
		
			case 'Facebook': window.open('https://www.facebook.com/dialog/feed?app_id=324223904344886&link='+midiaUrl+'&picture='+midiaImage+'&name='+midiaTitle+'&caption='+midiaCaption+'&description='+midiaDescription+'&redirect_uri=http://facebook.com/&display=popup', 'Facebook', 'width=400, height=400'); break;       
			case 'Twitter' : window.open('https://twitter.com/intent/tweet?text=' + midiaTitle + '&url=' + midiaUrl, 'Twitter', 'width=600, height=400'); break;
			case 'Pinterest' : window.open('http://pinterest.com/pin/create/button/?url=' + midiaUrl + '&media=' + midiaImage + '&description=' +midiaTitle, 'Twitter', 'width=600, height=400'); break;
		}
	});
	
	// Pega o item das MIDIAS SOCIAIS pelo click
	$('.list li img').click(function(){
		midiaTitle = $(this).attr('midiaTitle');
		midiaUrl = $(this).attr('midiaUrl'); 
		midiaImage = $(this).attr('midiaImage'); 
		midiaCaption = $(this).attr('midiaCaption');
		midiaDescription = $(this).attr('midiaDescription');


		switch($(this).attr('alt'))
		{																			  
			case 'Facebook': window.open('https://www.facebook.com/dialog/feed?app_id=324223904344886&link='+midiaUrl+'&picture='+midiaImage+'&name='+midiaTitle+'&caption='+midiaCaption+'&description='+midiaDescription+'&redirect_uri=http://facebook.com/&display=popup', 'Facebook', 'width=400, height=400'); break;
			case 'Twitter' : window.open('https://twitter.com/intent/tweet?text=' + midiaTitle + '&url=' + midiaUrl, 'Twitter', 'width=600, height=400'); break;
			case 'Pinterest' : window.open('http://pinterest.com/pin/create/button/?url=' + midiaUrl + '&media=' + midiaImage+ '&description=' +midiaTitle, 'Twitter', 'width=600, height=400'); break;
		}
	});
});
///valida Email
	$.validateEmail = function (email)
	{
		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
		if(er.exec(email))
			return true;
		else
			return false;
	};
// VALIDAR FORMS
function validaForm(formID)
{
	var formulario = document.getElementById(formID);
	var f = formulario.getElementsByTagName("input");
	var txtArea = formulario.getElementsByTagName("textarea");
	var error = 'PREENCHA OS CAMPOS\n\n';
	var cont = 0;
	
	// Faz o loop pelo inputs do form
	for(i=0; i<f.length; i++)
	{
		if(f[i].id != 'submit' && f[i].id != 'file-original' && f[i].id != 'file-falso')
		{
			if(f[i].value == f[i].defaultValue || f[i].value == '')
			{
				jQuery(f[i]).addClass('error');
				error += f[i].defaultValue + '\n';	
				cont = 1;
			}
			if(f[i].id == 'E-mail'){
				if($.validateEmail(f[i].value)==false){
					jQuery(f[i]).addClass('error');
				error += f[i].defaultValue + '\n';	
				cont = 1;	
				}	
			}
		}
	}
	
	// Faz o loop pelo textareas do form
	for(i=0; i<txtArea.length; i++)
	{
		if(txtArea[i].value == txtArea[i].defaultValue || txtArea[i].value == '')
		{
			jQuery(txtArea[i]).addClass('error');
			error += txtArea[i].defaultValue + '\n';	
			cont = 1;
		}
	}
	
	if(cont==0)
	{
		return true;
	} else {
		//alert( error );
		jQuery('#status').html('<span class="red">Campos incorretos. Favor verificar em destaque.</span>')
		return false;			
	}
}

//MASCARA PARA INPUTS ---------------------------------------------------------------//
function mascara(src, mask){
	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
		src.value += texto.substring(0,1);
	}
} 

//PERMITE APENAS NUMEROS DE OUTRA FORMA EM INPUTS ---------------------------------------------------//
function SomenteNumero(){ 
	if (event.keyCode<48 || event.keyCode>57){ 
		return false; 
	} 
} 

//PERMITE APENAS LETRAS SEM NUMEROS --------------------------------//
$('.checkString').keyup(function(event){
	var val = $(this).val();
		
	function isAlphaOrParen(str) {
  		return /^[a-zA-Z()]+$/.test(str);
	}

	if(isAlphaOrParen(val) == false){
		$(this).val('');
		event.preventDefault();
	}
  
});
 
  



// METODO DO EMAIL COMPARTILHAR PARA UM AMIGO
function emailCompartilhar()
{
	seuNome = jQuery('#seuNome').val();	
	seuEmail = jQuery('#seuEmail').val();
	amigoNome = jQuery('#amigoNome').val();
	amigoEmail = jQuery('#amigoEmail').val();
	compartilhaMensagem = jQuery('#compartilhaMensagem').val();
	compartilharProdImgURL = jQuery('#compartilharProdImgURL').val();
	compartilharProdURL = jQuery('#compartilharProdURL').val();
	compartilharProdNome = jQuery('#compartilharProdNome').val();
	compartilharTipo = jQuery('#compartilharTipo').val();
	
	jQuery.ajax({
	  type: 'POST',
	  //url: $(this).attr( 'href' ),
	  url: TEMPLATE_URL + 'sendmail/email-compartilhar.php',
	  data: { 
	  	seuNome: seuNome, 
		seuEmail: seuEmail, 
		amigoNome: amigoNome, 
		amigoEmail: amigoEmail, 
		compartilhaMensagem: compartilhaMensagem,
		compartilharProdImgURL: compartilharProdImgURL,
		compartilharProdURL: compartilharProdURL,
		compartilharProdNome: compartilharProdNome,
		compartilharTipo: compartilharTipo
	  },
	  success: function( results ) {	
	 
	  		if(results == '<span class="green">Enviado com sucesso!</span>')
			{
				jQuery('#seuNome').val( jQuery('#seuNome').attr( 'defaultValue' ) );	
				jQuery('#seuEmail').val( jQuery('#seuEmail').attr( 'defaultValue' ) );
				jQuery('#amigoNome').val( jQuery('#amigoNome').attr( 'defaultValue' ) );
				jQuery('#amigoEmail').val( jQuery('#amigoEmail').attr( 'defaultValue' ) );	
				jQuery('#compartilhaMensagem').val( jQuery('#compartilhaMensagem').attr( 'defaultValue' ) );
			}
			
			jQuery('#compartilharStatus').html( results	);
	  }
	});
	
	return false;
}