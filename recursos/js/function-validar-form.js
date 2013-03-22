function validar(){
		var nome = document.form.nomes.value;
		var email = document.form.emails.value;
		//alert(nome);
		
		if(nome == "" || nome == "Digite seu nome"){
			document.form.nomes.focus(); 
			document.form.resposta.style.border = "solid px #F00";
			document.form.resposta.style.color ="#f6f9f9";
			document.form.resposta.style.fontSize = "14px";
			document.form.resposta.style.fontFamily = "verdana";
			document.form.resposta.value = "Preencha o campo nome!";
			
			return false;
		}	
		
		if(email == "" || document.form.emails.value.indexOf("@")== -1 || document.form.emails.value.indexOf(".") == -1 ){
			document.form.emails.focus(); 
			document.form.resposta.style.border = "solid 0px #F00";
			document.form.resposta.style.color ="#f6f9f9";
			document.form.resposta.style.fontSize = "14px";
			document.form.resposta.style.fontFamily = "verdana";
			document.form.resposta.value = "Digite um Email válido!";
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