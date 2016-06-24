function cadastrar(form){
  $("#cadastrar_btn").button("loading");
  $.getJSON({   
    type: 'POST',   
    url: "api/cadastarUsuario.php",   
    data: $(form).serialize(),
    success: function(x){
        console.log(x);
      $("#cadastrar_btn").button("reset");
      if(x.error != null || x.return_code != 0){
        if(x.error_cod == 1062){
          var alert = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Email já cadastrado!</strong> Seu email já está cadastrado em nosso sistema! </div>";
          $("#alertArea_cadastro").html(alert);
        }
      }else{
        var alert = "<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"$('#cadastro').modal('hide');\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Sucesso!</strong> Você foi cadastrado com sucesso em nosso sistema. <a href=\"#\" onclick=\"$('#cadastro').modal('hide'); $('#login').modal('show');\">Click aqui</a> para fazer login.</div>";
        $("#alertArea_cadastro").html(alert);
     //   $("#cadastrar_btn").prop("disabled",true);
      }
    }
  }); 
}
function logar(form){
  $("#login_btn").button("loading");
  $.getJSON({
    type: 'POST',
    url: "api/login.php",
    data: $(form).serialize(),
    success: function(x){
      console.log(x);
      $("#login_btn").button("reset");
      if(x.error == null && x.return_code == 0){
        window.location.replace("main.php");
      }else{
        var alert = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"$('#cadastro').modal('hide');\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Senha ou Usuario incorretos</strong></div>";
        $("#alertArea_login").html(alert);
      }
    } 
  });
}
function sair(){
    $.getJSON({
        url: "api/logout.php",
        success: function(x){
            window.location.replace("main.php");
        } 
    });
}

function cadastrarContato(form){
  $("#cadastrar_btn").button("loading");
  var data = new FormData(form);
  $.ajax({   
    type: 'POST',   
    url: "api/cadastrarContato.php",   
    data: data,
    processData: false,
    contentType: false,
    success: function(x){
        console.log(x);
      $("#cadastrar_btn").button("reset");
      if(x.error != null || x.return_code != 0){
        console.log(x);
      }else{
        cadastrarNumerosContato(x['insert_id']);
      }
    }
  }); 
}

function cadastrarNumerosContato(id){
  if(!editar)
    console.log("Cadastrando Numeros");
  else
    console.log("Atualizando Numeros");
    
  var numeros = [];
  var numeros_id = [];
  
  if($("#nphone").val() != ""){
    numeros.push({id:$("#nphone").data("id"), phone:$("#nphone").val()});
  }
  $("#phoneList > .form-group > .input-group > input").each(function(){
    console.log($(this).data("id"));
    if($(this).val() != "")
      numeros.push({id:$(this).data("id"), phone:$(this).val()});
  });
  console.log("call API: api/cadastrarNumero.php?id="+id+"&numeros="+JSON.stringify(numeros)+((editar) ? "&editar=true" : "" ));
  if(numeros.length == 0)
    return;
    
    console.log(numeros);
  $.getJSON({  
    url: "api/cadastrarNumero.php?id="+id+"&numeros="+JSON.stringify(numeros)+((editar) ? "&editar=true" : "" ),
    success: function(x){
      console.log(x);
      $("#cadastrar_btn").button("reset");
      if(x.error != null || x.return_code != 0){
        console.log(x);
      }else{
        alert("Cadastrado com sucesso!");
      }
    }
  }); 
}