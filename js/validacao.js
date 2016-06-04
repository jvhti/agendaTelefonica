if (typeof jQuery === 'undefined') {
  throw new Error('Validação requer jQuery');
}

$( document ).ready(function() {
	$("form").each(function(){$(this).on("submit", executarValidacao);});
	$("[validate]").on("keyup", function(e){validateField(this);});
	$("[validate]").on("focus", function(e){validateField(this);});
	$("[mask]").mask("00/00/0000");
});

var MAX_TEXT_SIZES = 255;
var MAX_PASSWORD_SIZE = 16;

function executarValidacao(e){
	var fields = $(this).find("[validate]").get();
	var isValid = true;

	for(var i = 0; i < fields.length; ++i)
		isValid = isValid ? validateField(fields[i], true) : false;
	if(!isValid)
		e.preventDefault();
	else{
		var onval = $(this).attr("onValidSubmit");
		if(!(onval == null || onval === typeof undefined || !onval || onval == "")){
			eval(onval+"(this);");
			e.preventDefault();
		}
	}
}

function validateField(campo, formSended){
	var type = $(campo).attr("validate");
	switch(type){
		case "emailField":
			return validateEmail($(campo).val(), campo, formSended);
		break;
		case "checkbox":
			return validateCheckbox($(campo).prop('checked'), campo, formSended);
		break;
		case "text":
			return validateText($(campo).val(), campo, formSended);
		break;
		case "password":
			return validatePassword($(campo).val(), campo, formSended);
		break;
		case "form":
			return true;
		break;
	}

	return true;
}

function validateEmail(email, field, formSended){
	var res = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email);	

	if(!res && formSended){
		$(field).attr("title", "E-mail Inválido!");
		$(field).attr("data-content","Seu e-mail não parece ser válido, por favor verifique.");
		$(field).attr("data-placement", "top");
		$(field).popover('show');
	}
	$(field).focus(
		function(){$(this).popover("hide");}
	);
	$(field).parent().find(".glyphicon").removeClass().addClass("glyphicon").addClass(email === "" ? "glyphicon-user" : (res ? "glyphicon-ok" : "glyphicon-remove"));

	return res;
}

function validateCheckbox(check, field, formSended){
	var res =  ($(field).attr('validateRequired') == "true" && check);
	if(!res && formSended){
		$(field).attr("title", "Você precisa marcar");
		if($(field).attr("data-content") == "")
			$(field).attr("data-content","Seu e-mail não parece ser válido, por favor verifique.");
		$(field).attr("data-placement", "top");
		$(field).popover('show');
	}
	if(!res && !formSended){
		$(field).popover("hide");
	}
	return res;
}

function validateText(text, field, formSended){

	if($(field).attr("validadeMinSize") == null || $(field).attr("validadeMinSize") === typeof undefined || !$(field).attr("validadeMinSize"))
		$(field).attr("validadeMinSize", ""); 
	if($(field).attr("validadeMaxSize") == null || $(field).attr("validadeMaxSize") === typeof undefined || !$(field).attr("validadeMaxSize"))
		$(field).attr("validadeMaxSize", ""); 
	var res =  ($(field).attr('validateRequired') == "true" && text.length >= ($(field).attr("validadeMinSize") != "" ? $(field).attr("validadeMinSize") : 0) && text.length < ($(field).attr("validadeMaxSize") != "" ? $(field).attr("validadeMaxSize") : MAX_TEXT_SIZES));
	if(!res && formSended){
		$(field).attr("title", "Tamanho Inválido");
		$(field).attr("data-content","Este campo precisa ter "+($(field).attr("validadeMinSize") != "" ? "no minimo "+$(field).attr("validadeMinSize")+" caracteres" : "")+($(field).attr("validadeMaxSize") != "" ? "e no maximo "+$(field).attr("validadeMaxSize")+" caracteres" : "")+".");
		$(field).attr("data-placement", "top");
		$(field).popover('show');
	}
	if(!res && !formSended){
		$(field).popover("hide");
	}
	return res;
}

function validatePassword(pass, field, formSended){
	console.log(pass);

	var res = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(pass) && pass.length <= MAX_PASSWORD_SIZE;
	
	console.log(" RES : "+res);

	var vcc = $(field).attr("validateCheckConfirmation");
	console.log(" VCC : "+vcc);
	if(!(vcc == null || vcc === typeof undefined || !vcc) && res){
		console.log(" VCC é valido");
		res = res ? pass.toString() === $("#"+vcc).val().toString() : res;
		console.log(" NOVO RES : "+res);
		vcc = true;
	}else
		vcc = false;
	
	if(!res && formSended){
		$(field).attr("title", "Senha Inválida");
		$(field).attr("data-content","A senha precisa ter:<br/><ul><li>Minimo de 8 caracteres e máximo de 16 caracteres.</li><li>Ao menos 1 letra.</li><li>Ao menos 1 número.</li>"+(vcc ? "<li>Ser iqual a confirmação.</li>" : "")+"</ul>");
		$(field).attr("data-placement", "top");
		$(field).popover({ html : true });
		$(field).popover('show');
	}
	if(!res && !formSended){
		$(field).popover("hide");
	}
	return res;
}