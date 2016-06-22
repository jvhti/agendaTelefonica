<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['email']) || $_SESSION['email'] == ""){
    header("Location: index.php");
  }
?>
<html lang="pt-Br">

<head>
  <!-- --------------- Meta --------------- -->
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="description" content="Projeto criado para a disciplina de Linguagem de Programação II, no curso de Informática do Instituto Federal Goiano - Câmpus Ceres."/>
  <meta name="keywords" content="projeto, html, css, linguagem de programação, if goiano, ceres, agenda, lista telefonica, ensino medio, tecnico, informatica" />
  <meta name="author" content="João Víctor de Oliveira Santos, Matheus Henrique, Lúcio Americo, Marcos" />
  <!-- --------------- Meta --------------- -->
  
  <title>Agenda</title>
	
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="css/mystyle.css" type="text/css" />
</head>

<body class="agendaBody">
  <!-- -------------- NavBar -------------- -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarAgenda" aria-expanded="false">
          <span class="sr-only">Ativar navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img alt="Brand Icon" class="img-responsive brandImg" src="img/logo.png"/></a>
      </div>

      <nav class="collapse navbar-collapse" id="navbarAgenda">
        <ul class="nav navbar-nav">
          <li class="openContent"><a id="homeLI" default='true' href="res/welcome.html">Inicio <span class="sr-only">(current)</span></a></li>
          <li class="openContent"><a id="agendaLI"  default='false' href="res/agenda.html">Agenda</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Extra <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="openContent"><a id="cadLI" href="res/cadastrarContato.php">Adicionar Contato</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#" onclick="sair();">Sair</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" onclick="sair();">Sair</a></li>
        </ul>
        <form class="navbar-form navbar-right" role="search">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Procurar Contato"/>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
              </span>
            </div>
          </div>
        </form> 
      </nav><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <!-- -------------- NavBar -------------- -->
  
  <!-- --------------- Main --------------- -->
  <main class="container-fluid" id="content">
  </main>
  <!-- --------------- Main --------------- -->

  <noscript>
    <style type="text/css">
      nav, main {display:none !important;}
      .noscriptmsg {height: 100vh; display:flex; align-items:center;}
      .agendaBody {background-image: none !important; background-color:FloralWhite;}
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

  <!-- ------------- Scripts -------------- -->
  <script type="text/javascript" src="js/jquery-2.2.3.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/api.js"></script>
</body>
</html>