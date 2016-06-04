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
    <!-- --------------- Meta --------------- -->
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Projeto criado para a disciplina de Linguagem de Programação II, no curso de Informática do Instituto Federal Goiano - Câmpus Ceres."/>
    <meta name="keywords" content="projeto, html, css, linguagem de programação, if goiano, ceres, agenda, lista telefonica, ensino medio, tecnico, informatica" />
    <meta name="author" content="João Víctor de Oliveira Santos, Matheus Henrique, Lúcio Americo, Marcos" />
    <!-- --------------- Meta --------------- -->
    
  	<title>CellBook</title>
  	
  	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  	<link rel="stylesheet" href="css/mystyle.css" type="text/css" />
  </head>
  
  <body>
   	<!-- ----------- Conteudo principal ------------------ -->
    <main class="jumbotron mainJumbotron">
  		<div class="container mainContainer">
  			<div class="row">
  				<div class="col-md-12">
  					<h1 class="page-header">CellBook</h1>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-11 col-md-offset-1">
  					<h2 class="sub-page-header">Come to our side of the force. Here you can add all cell phone numbers, from all your friends...</h2>
  				</div>
  			</div>
  			<div class="row buttons-container">
  				<div class="col-md-4 col-md-offset-8 col-sm-6">
  					<nav role="navigation" class="btn-group btn-group-lg">
  						<a href="#" aria-label="Criar conta" role="button" onclick="$('#cadastro').modal('show');" class="btn btn-primary btn-lg min100">Crie sua conta</a>
  						<a href="#" role="button" onclick="$('#login').modal('show');" class="btn btn-default btn-lg min100">Já tem conta?</a>
  					</nav>
  				</div>
  			</div>
  		</div>
  	</main>
    <!-- ----------- Conteudo principal ------------------ -->
    <!-- --------------- Modal Login --------------------- -->
  	<div id="login" class="modal fade" role="dialog">
       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="modal-title text-center">Login</h2>
            </div>
            <form validate="form" onValidSubmit="logar" method="post" target="noscript/logar.php">  <!-- Form Login -->
              <div class="modal-body">
                <span id="alertArea_login"></span>
                <div class="form-group">
                  <label for="email_in">E-mail: </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input aria-required="true" type="text" name="email_in" data-trigger="manual" class="form-control" id="email_in" validate="emailField" validateRequired="true"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password_in">Password: </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>
                    </div>
                    <input aria-required="true" name="password_in" type="password" class="form-control" id="password_in"/>
                  </div>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="remember_in"/> Lembrar-se de mim
                  </label>
                </div>
                <div class="text-right"><a href="#" onclick="$('#login').modal('hide');$('#recuperar').modal('show');">Esqueceu a senha?</a></div>
              </div>
              <div class="modal-footer">
                <button id="login_btn" data-loading-text="Login..." type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
            </form>  <!-- Form Login -->
          </div>
      </div>
    </div>
    <!-- --------------- Modal Login --------------------- -->
    <!-- ------------- Modal Recuperar ------------------- -->
    <div id="recuperar" class="modal fade" role="dialog"> <!-- Modal Recuperar -->
       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="modal-title text-center">Recuperar Senha</h2>
            </div>
            <form validate="form">  <!-- Form Recuperar -->
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
            </form>  <!-- Form Recuperar -->
          </div>
      </div>
    </div>
    <!-- ------------- Modal Recuperar ------------------- -->
    <!-- -------------- Modal Cadastro ------------------- -->
    <div id="cadastro" class="modal fade" role="dialog">
       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="modal-title text-center">Cadastro</h2>
            </div>
            <form onValidSubmit="cadastrar">  <!-- Form Cadastro -->
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
            </form>  <!-- Form Cadastro -->
          </div>
      </div>
    </div>
    <!-- -------------- Modal Cadastro ------------------- -->
    
    <noscript>
      <style type="text/css">
        main {display:none !important;}
        .noscriptmsg {height: 100vh; display:flex; align-items:center;}
        body{background-color:FloralWhite;}
      </style>
      <div class="noscriptmsg">
        <div class="container">
          <div class="alert alert-danger">
            <h1 class="page-header"> Para completa funcionalidade deste site é necessário habilitar o JavaScript.</h1>
            Aqui estão as <a href="http://www.enable-javascript.com/pt/" target="_blank">
            instruções de como habilitar o JavaScript no seu navegador</a>.
          </div>
        </div>
      </div>
    </noscript>
    
    <!-- ------------------ Scripts ---------------------- -->
  	<script type="text/javascript" src="js/jquery-2.2.3.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/validacao.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/api.js"></script>
    <!-- ------------------ Scripts ---------------------- -->
  </body>
</html>