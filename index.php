<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leite de Rosas</title>
<link rel="stylesheet" href="recursos/css/reset.css" type="text/css">
<link rel="stylesheet" href="recursos/css/style.css" type="text/css">
<link href='http://www.leitederosas.com.br/favicon.ico' rel='icon' type='image/x-icon'> 
<link href='http://www.leitederosas.com.br/favicon.ico' rel='shortcut icon' type='image/x-icon'/>  
<!--[if IE ]><link rel="stylesheet" href="recursos/css/ie.css" type="text/css"><![endif]-->
<script type="text/javascript" src="recursos/js/jquery.min.js"></script>
	<script type="text/javascript" src="recursos/js/PictureSlides-jquery-2.0.js"></script>
	
	<script type="text/javascript">
		jQuery.PictureSlides.set({
			// Switches to decide what features to use
			useFadingIn : true,
			useFadingOut : true,
			useFadeWhenNotSlideshow : true,
			useFadeForSlideshow : true,
			useDimBackgroundForSlideshow : true,
			loopSlideshow : false,
			usePreloading : true,
			useAltAsTooltip : true,
			useTextAsTooltip : false,
			
			// Fading settings
			fadeTime : 500, // Milliseconds	
			timeForSlideInSlideshow : 2000, // Milliseconds

			// At page load
			startIndex : 1,	
			startSlideShowFromBeginning : true,
			startSlideshowAtLoad : false,
			dimBackgroundAtLoad : false,

			// Large images to use and thumbnail settings
			images : [
				{
					image : "recursos/images/image-2.jpg", 
					alt : "",
					text : "This is picture 1"
				},
				{                                  
					image : "recursos/images/image-1.jpg", 
					alt : "",
					text : "This is picture 2"
				},
				{                                  
					
					image : "recursos/images/image-3.jpg", 
					alt : "",
					text : "This is picture 3",
					
				},
				{                                  
					
					image : "recursos/images/image-4.jpg", 
					alt : "",
					text : "This is picture 4",
					
				}
			],
			thumbnailActivationEvent : "click",

			// Classes of HTML elements to use
			mainImageClass : "picture-slides-image", // Mandatory
			mainImageFailedToLoadClass : "picture-slides-image-load-fail",
			imageLinkClass : "picture-slides-image-link",
			fadeContainerClass : "picture-slides-fade-container",
			imageTextContainerClass : "picture-slides-image-text",
			previousLinkClass : "picture-slides-previous-image",
			nextLinkClass : "picture-slides-next-image",
			imageCounterClass : "picture-slides-image-counter",
			startSlideShowClass : "picture-slides-start-slideshow",
			stopSlideShowClass : "picture-slides-stop-slideshow",
			thumbnailContainerClass: "picture-slides-thumbnails",
			dimBackgroundOverlayClass : "picture-slides-dim-overlay"
		});
	</script>
	<script type="text/javascript" src="recursos/js/function-validar-form.js"></script>
	<script type="text/javascript" src="recursos/js/function-validar-form-email.js"></script>
</head>

<body>
<div class="All">
	<div id="Header">
		<h1 class="Logo">
			<img src="recursos/images/logo.png" alt="" width="406px" />
		</h1>
		<div class="Socialnetwork">
		<ul class="">
			<li><a href="http://www.facebook.com/LeiteDeRosas" target="_blank"><img src="recursos/images/facebook.png" alt="" width="43px" /></a></li>
			<!--<li><a href="" target="_blank"><img src="recursos/images/twitter.png" alt="" width="43px" /></a></li>-->
		</ul>
		</div>
	</div>
    <div id="Content">
		<?php include "banner.php"; ?>        
		<div class="Column" id="form">
			<div class="Titlecolunm">
				<h2>Newsletter</h2>
				<p>Cadastre-se e fique por dentro de todas as novidades.</p>
			</div>
			<form method="post"  action="include/grava.php" name="form">
				<input class="" type="text" value="Digite seu nome" onkeypress="mascara(this,soLetras)" name="nomes" onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/>
				<input class="" type="text" value="Digite seu e-mail" name="emails" onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/>
				<input type="text" readonly="readonly" size="30" style="background:#da0863; color: rgb(246, 249, 249); font-size: 14px; font-family: verdana;width: 292px;" id="valida-form" name="resposta" value="<?php if (isset($_SESSION['flash']) == "Seu cadastro foi realizado com sucesso"): echo $_SESSION['flash']; unset($_SESSION['flash']); endif; ?>">
                <input class="Inputenviar" onclick="return validar();" type="submit" value="" />                				
			</form>
            
			
			<div class="Socialnetwork">
				<h2><img src="recursos/images/img-noticias.png" alt="" width="140px" /></h2>
				<ul class="">
					<li><a href="http://www.facebook.com/LeiteDeRosas" target="_blank"><img src="recursos/images/facebook.png" alt="" width="43px" /></a></li>
					<!--<li><a href="" target="_blank"><img src="recursos/images/twitter.png" alt="" width="43px" /></a></li>-->
				</ul>
			</div>
		</div>
		<div class="Column2">
			<div class="Titlecolunm">
				<h2>Fale com a gente</h2>
				<p>Dúvidas? Sugestões?</p>
			</div>
			<form method="post"  action="include/envia.php" name="formu">
				<input class="" type="text" value="Digite seu nome" name="nome" onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/>
				<input class="" type="text" value="Digite seu e-mail" name="email"  onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/>
				<div class="styled-select">
					<select name="estado">
						<option>RJ</option>
						<option>ES</option>
						<option>SP</option>
						<option>SC</option>
						<option>MG</option>
					</select>
				</div>
				<input class="Inputcidade" type="text" value="Cidade" name="cidade" onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/>
				<textarea class="Inputtextarea"  value="Mensagem" name="mensagem" text="Mensagem" onfocus="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"></textarea>
                <input type="text" readonly="readonly" size="30" style="background:#da0863; color: rgb(246, 249, 249); font-size: 14px; font-family: verdana;width: 350px;" id="valida-form" name="respostanews" value="<?php if (isset($_SESSION['flash1'])): echo $_SESSION['flash1']; unset($_SESSION['flash1']); endif; ?>">
				<input class="Inputenviar" onclick="return validarnews();" type="submit" value="" />
			</form>
		</div>
    </div>
	<div id="Footer">
		<a href="mailto:sac@leitederosas.com.br" target="_blank"><img src="recursos/images/img-sac.png" alt="" width="187px" /></a>
		<a href="http://dizain.com.br/" target="_blank"><img class="logodizain" src="recursos/images/logo-dizain.png" alt="Dizain" title="Dizain" width="64px" /></a>
		
		
	</div>
</div>
</body>
</html>
