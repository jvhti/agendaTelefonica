<!DOCTYPE html>
<?php
  session_start();
  if(isset($_SESSION['email']) && $_SESSION['email'] != ""){
  //echo "Logado";
    header("Location: main.php");
  }
?>
<html lang="pt-Br">
<head>
	<meta charset="utf-8">
	<title>Number Book</title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css" >
</head>
<body>
	<div id="login" class="modal fade" role="dialog">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center">Login</h2>
          </div>
          <form validate="form" onValidSubmit="logar">
            <div class="modal-body">
              <span id="alertArea_login"></span>
              <div class="form-group">
                <label for="email_in">E-mail: </label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" name="email_in" data-trigger="manual" class="form-control" id="email_in" validate="emailField" validateRequired="true"/>
                </div>
              </div>
              <div class="form-group">
                <label for="password_in">Password: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-lock"></span>
                  </div>
                  <input name="password_in" type="password" class="form-control" id="password_in"/>
                </div>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="remember_in"/> Lembrar-se de mim
                </label>
              </div>
              <div style="text-align:right"><a href="#" onclick="$('#login').modal('hide');$('#recuperar').modal('show');">Esqueceu a senha?</a></div>
            </div>
            <div class="modal-footer">
              <button id="login_btn" data-loading-text="Login..." type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  <div id="recuperar" class="modal fade" role="dialog">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center">Recuperar Senha</h2>
          </div>
          <form validate="form">
            <div class="modal-body">
              <span id="alertArea_recuperar"></span>
              <div class="form-group">
                <label for="login_rec">E-mail: </label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" id="login_rec"  validate="emailField" validateRequired="true"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  <div id="cadastro" class="modal fade" role="dialog">
     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center">Cadastro</h2>
          </div>
          <form onValidSubmit="cadastrar">
            <div class="modal-body">
              <span id="alertArea_cadastro"></span>
              <div class="form-group">
                <label for="name_cad">Nome: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user"></span>
                  </div>
                  <input type="text" class="form-control" id="name_cad" name="name_cad" validateRequired="true" validate="text" validadeMinSize="5"/>
                </div>
              </div>
              <div class="form-group">
                <label for="email_cad">E-mail: </label>
                <div class="input-group">
                  <span class="input-group-addon"><span class=" glyphicon glyphicon-envelope"></span></span>
                  <input type="text" class="form-control" name="email_cad" id="email_cad" validate="emailField" validateRequired="true"/>
                </div>
              </div>
              <div class="form-group">
                <label for="password_cad">Senha: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-lock"></span>
                  </div>
                  <input type="password" class="form-control" id="password_cad" name="password_cad" validate="password" validateRequired="true" validateCheckConfirmation="password_cad_conf"/>
                </div>
              </div>
              <div class="form-group">
                <label for="password_cad_conf">Confimação de Senha: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-lock"></span>
                  </div>
                  <input type="password" class="form-control" id="password_cad_conf" name="password_cad_conf"  validate="password" validateRequired="true" validateCheckConfirmation="password_cad"/>
                </div>
              </div>
              <div class="form-group">
                <label for="gender_cad">Sexo: </label>
                <select class="form-control" id="gender_cad" name="gender_cad">
                  <option>Masculino</option>
                  <option>Feminino</option>
                  <option>Não declarar</option>
                </select>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="termos_cad" validate="checkbox" validateRequired="true" data-content="Você precisa aceitar os termos de uso para se cadastrar!" data-trigger="manual"/> Aceito os termos de uso
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button id="cadastrar_btn" data-loading-text="Cadastrando..." type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </div>
          </form>
        </div>
    </div>
  </div>
	<div style="height:100%;min-height:100%; margin: 0px; background-image: url('img/agenda.jpg'); background-size: cover ; background-repeat: no-repeat" class="jumbotron">
		<div class="container" style="margin-top:65px">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header" style="text-shadow:1px 4px 10px black; color:white">CellBook</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-11 col-md-offset-1">
					<h2 style="margin-left:25px; color:white">Come to our side of the force. Here you can add all cell phone numbers, from all your friends...</h2>
				</div>
			</div>
			<div class="row" style="margin-top: 50px">
				<div class="col-md-4 col-md-offset-8 col-sm-6">
					<div class="btn-group btn-group-lg">
						<a href="#" style="min-width:100px" onclick="$('#cadastro').modal('show');" class="btn btn-primary btn-lg">Crie sua conta</a>
						<a href="#" style="min-width:100px" onclick="$('#login').modal('show');" class="btn btn-default btn-lg">Já tem conta?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script	src="js/jquery-2.2.3.js"></script>
	<script	src="js/bootstrap.js"></script>
  <script src="js/jquery.mask.js"></script>
  <script type="text/javascript">
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
      if(x.error != null || x.return_code != 1){
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
  </script>
  <script type="text/javascript" src="js/validacao.js"></script>
</body>
</html>