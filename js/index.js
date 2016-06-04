///@author: jvhti@hotmail.com
function mostrarAlert(cod){
  if(cod == 1){
    var alert = "<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"$('#recuperar').modal('hide');\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Sucesso!</strong> Um email contendo a nova senha foi enviado para você. <a href=\"#\" onclick=\"$('#recuperar').modal('hide'); $('#login').modal('show');\">Click aqui</a> para fazer login.</div>";
    $("#alertArea_recuperar").html(alert);
  }
}

function cadastrar(form){
  $("#cadastrar_btn").button("loading");
  $.getJSON({   
    type: 'POST',   
    url: "api/cadastarUsuario.php",   
    data: $(form).serialize(),
    success: function(x){
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