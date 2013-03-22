function validarnews(){
		var nome1 = document.formu.nome.value;		
		var email1 = document.formu.email.value;
		var cidade1 = document.formu.cidade.value;
		var Mensagem = document.formu.mensagem.value;
		//alert(nome1);
		
		if(nome1 == "" || nome1 == "Digite seu nome"){
			document.formu.nome.focus(); 
			document.formu.respostanews.style.border = "solid px #F00";
			document.formu.respostanews.style.color ="#f6f9f9";
			document.formu.respostanews.style.fontSize = "14px";
			document.formu.respostanews.style.fontFamily = "verdana";
			document.formu.respostanews.value = "Preencha o campo nome!"
			
			return false;
		}	
		
		if(email1 == "" || document.formu.email.value.indexOf("@")== -1 || document.formu.email.value.indexOf(".") == -1 ){
			document.formu.email.focus(); 
			document.formu.respostanews.style.border = "solid 0px #F00";
			document.formu.respostanews.style.color ="#f6f9f9";
			document.formu.respostanews.style.fontSize = "14px";
			document.formu.respostanews.style.fontFamily = "verdana";
			document.formu.respostanews.value = "Digite um Email válido!";
			return false;
		}
		if(cidade1 == "" || cidade1 == "Cidade"){
			document.formu.cidade.focus(); 
			document.formu.respostanews.style.border = "solid px #F00";
			document.formu.respostanews.style.color ="#f6f9f9";
			document.formu.respostanews.style.fontSize = "14px";
			document.formu.respostanews.style.fontFamily = "verdana";
			document.formu.respostanews.value = "Preencha a cidade!"
			
			return false;
		}
		if(Mensagem == "" || Mensagem == "Mensagem"){
			document.formu.mensagem.focus(); 
			document.formu.respostanews.style.border = "solid px #F00";
			document.formu.respostanews.style.color ="#f6f9f9";
			document.formu.respostanews.style.fontSize = "14px";
			document.formu.respostanews.style.fontFamily = "verdana";
			document.formu.respostanews.value = "Preencha a mensagem!"
			
			return false;
		}
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function soLetras(v){  
return v.replace(/\d/g,"") //Remove tudo o que não é Letra  
} 