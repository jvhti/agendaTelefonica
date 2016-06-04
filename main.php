<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['email']) || $_SESSION['email'] == ""){
//    echo "Não Logado";
    header("Location: index.php");
  }
?>
<html lang="pt-Br">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Agenda</title>
    <link href="css/bootstrap.css" rel="stylesheet"></link>
    <link rel="stylesheet" href="css/mystyle.css" type="text/css" />
  </head>
  <body style="background-image:url('img/draft.png'); background-size:fill;">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Ativar navegação</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img alt="Brand" style="width:25px" class="img-responsive" src="img/logo.png"/></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="openContent"><a id="homeLI" default='true' href="res/wellcome.html">Inicio <span class="sr-only">(current)</span></a></li>
            <li class="openContent"><a id="agendaLI"  default='false' href="res/agenda.html">Agenda</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Extra <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="openContent"><a id="cadLI" href="res/cadastrarContato.html">Adicionar Contato</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="index.html">Sair</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html">Sair</a></li>
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
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid" id="content">

    </div>
    <script src="js/jquery-2.2.3.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
///@author: jvhti@hotmail.com

var loadedPage = "";
var loadedPageItem = null;
function openButDontActive(url){
  $(loadedPageItem).removeClass('active');
  loadedPageItem = null;
  loadedPage = "";
  loadContent(url);
}
function loadContent(curl){
  $.ajax({
    url: curl,
    cache: false,
    complete: function(t){ 
      //console.log("Response: "+t);
      $('#content').html(t.responseText);
    }
  });
}

$('li.openContent > a').each(function(){
  if($(this).attr('default') != null && $(this).attr('default') == 'true'){
    loadContent($(this).attr('href'));
    loadedPageItem = $(this).parent();
    if(!$(this).parent().hasClass('active'))
      $(this).parent().addClass('active');
  }
  $(this).on('click', function(e){
    e.preventDefault();
   // console.log("Abrindo: "+$(this).attr('href'));
    var url = $(this).attr('href');
    if(loadedPage != url && url != "#"){
      loadContent(url);
      if(loadedPageItem != null)
        $(loadedPageItem).removeClass('active');
      loadedPageItem = $(this).parent();
      $(this).parent().addClass('active');
    }
  });
});
    </script>
  </body>
</html>