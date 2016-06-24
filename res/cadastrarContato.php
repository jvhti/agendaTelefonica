<!DOCTYPE html>
<?php
  if(isset($_GET['id']) && $_GET['id'] != ""){
    include "../api/cfg/conexao.php";
    include "../api/cfg/upload.php";
    $id = $_GET['id'];
    
    $sql = "select * from Contact where id = $id;";
    $result = mysql_query($sql);
    if(!$result)
      die("MySQL error");
    if(mysql_num_rows($result) == 0){
      $id = -1;
      return;
    }
    $result = mysql_fetch_array($result);
    
    $name = $result['name'];
    $lastName = $result['lastName'];
    $email = $result['email'];
    $photo = $result['photo'];
    $city = $result['city'];
    $state = $result['state'];
    $address = $result['address'];
    $neighborhood = $result['neighborhood'];
    $notes = $result['notes'];
  }else{
    $id = -1;
    $name = "";
    $lastName = "";
    $email = "";
    $photo = "";
    $city = "";
    $state = "";
    $address = "";
    $neighborhood = "";
    $notes = "";
  }
?>

<div class="col-sm-8 col-sm-offset-2" style="">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="container-fluid">
        <div class="page-header">
          <h1><?php echo (($id == -1) ? "Cadastro de " : "Editar ") . "Contato";?></h1>
        </div>
        <form onValidSubmit="cadastrarContato" method="post" enctype="multipart/form-data">
          <input name="function" value="<?php echo ($id == -1) ? 'saveContact' : 'updateContact';?>" hidden/>
          <input name="id" value="<?php echo ($id == -1) ? '' : $id;?>" hidden/>
          <div class="row">
            <div class="col-md-4 col-md-push-8 col-sm-push-0">
              <div class="form-group">
                <label style="width: 75%; margin: auto; display: flex;">
                  <div class="image-container">
                    <img id="imagePreview" style="margin: auto;" class="img-circle" src="<?php echo ($photo == "" ? "imagens/no-avatar.jpg" : $profile_path.$photo); ?>"></img>
                    <div class="image-overlay">
                      Procurar
                    </div>
                    <div class="image-cancel-overlay">
                      <a onclick="removerImg();" class="btn">x</a>
                    </div>
                  </div>
                  <input type="file" name="foto" accept="image/*" style="display:none"/>
                </label>
              </div>
            </div>
            <div class="col-md-8 col-md-pull-4 col-sm-pull-0">
              <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>"/>
              </div>
              <div class="form-group">
                <label for="sobrenome">Sobrenome: </label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $lastName;?>"/>
              </div>
              <!--<div class="form-group">
                <label for="sname">Sobrenome: </label>
                <input type="text" class="form-control" id="sname"/>
              </div>-->
            </div>
          </div>
          <div class="form-group ">
            <label for="nphone">Telefone: </label>
            <div id="phoneList">
              <?php
  $numberCount = 0;
  if($id != -1){
    $sql = "select * from phone where Contact_id = $id;";
    $result = mysql_query($sql);
    if(!$result)
      die("MySQL error");
    $nr = mysql_num_rows($result);
    while($r = mysql_fetch_array($result)){
      if($numberCount < $nr - 1)
        echo '<div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span><input type="text" name="phone_'.$numberCount.'" class="form-control phoneInput" value="'.$r['phoneNumber'].'" data-id="'.$r['id'].'" id="phone_'.$numberCount.'"/></div></div>';
      else
        $lastNumber = $r;
      ++$numberCount;
    }
  }
              ?>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
              </span>
              <input name="nphone" type="text" class="form-control phoneInput" id="nphone" data-id="<?php echo ($id != -1) ? $lastNumber['id'] : ""; ?>" mask="" value="<?php echo ($id != -1) ? $lastNumber['phoneNumber'] : ""; ?>"/>
              <span class="input-group-btn">
                <a href="" class="btn btn-default" onclick="addInput($('#nphone'), $('#phoneList'), $(this), event);">+</a>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="email">E-mail: </label>
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
              <input type="email" class="form-control" validate="emailField" id="email" name="email" value="<?php echo $email;?>"/>
            </div>
          </div>
          <hr>
          <h3>Endereço:</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="estado">Estado: </label>
                <select class="form-control" id="estado" name="estado">
                  <option disabled selected>Selecione um Estado</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cidade">Cidade: </label>
                <select class="form-control" name="cidade" id="cidade">
                  <option disabled selected>Selecione uma Cidade</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="endereco">Endereço: </label>
                <input type="text" name="endereco" id="endereco" class="form-control"  value="<?php echo $address;?>"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control"  value="<?php echo $neighborhood;?>"/>
              </div>
            </div>
          </div>
          <hr>
          <div class="panel-group" style="width:100%;" id="accordion" role="tablist">
            <div class="panel panel-default">
              <a style="color:black; text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#notasCollapse" aria-expanded="true" aria-controls="notasCollapse">
                <div class="panel-heading" role="tab" id="notasHeader">
                  <h4 class="panel-title">Notas</h4>
                </div>
              </a>
              <div id="notasCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Notas">
                <div class="panel-body" style="padding:5px;">
                  <textarea name="notas" id="notas" rows="10" class="form-control" style="margin: 0px; padding:0px; width: 100%; max-width: 100%; min-width: 100%; resize:vertical; min-height: 2em; height: 100%;"><?php echo $notes;?></textarea>
                </div>
              </div>
            </div>
          </div>
          <input id="cadastrar_btn" data-loading-text="Login..." type="submit" class="btn btn-primary btn-block" value="Salvar"/>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript">

<?php
if($id != -1){
  echo "var state= '$state';";
  echo "var city= '$city';";
  echo "var editar=true;";
}else{
  echo "var editar=false;";
}
?>

function addInput(input, list, btn, ev){
   ev.preventDefault()
  if(input.val() == "") {alert("Para adicionar uma novo campo, primeiro você precisa digitar algo.");return;}
  if(list.attr('count') == null)
    list.attr('count', 0);
  else if(parseInt(list.attr('count')) > 7){
    btn.parent().remove();
    input.parent().children(".input-group-addon").children().removeClass("glyphicon-earphone").addClass("glyphicon-phone-alt");
    alert("Você atingiu o número maximo de telefones para um mesmo contato.");
    return;
  }
  list.append('<div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span><input type="text" name="phone_'+list.attr('count')+'" class="form-control phoneInput" id="phone_'+list.attr('count')+'"/></div></div>');
  $('#phone_'+list.attr('count')).val(input.val());
  input.val("");
  input.focus();
  list.attr('count', parseInt(list.attr('count')) + 1);
}

$("input[type='file']").change(function(x){
   var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

    if (/^image/.test( files[0].type)){ // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function(){ // set image data as background of div
          var height = $("#imagePreview").height();
          var width = $("#imagePreview").width();
          $("#imagePreview").attr("src", this.result).css("width", width).css("height", height);
          $(".image-overlay").text("Alterar"); 
        }
    }
});

function popularEstados(){
	$("#estado").html("<option disabled selected>Carregando...</option>");
  $.getJSON({
    url: "api/estado_cidade/estados.json",
	  success: function(x){
		  x = x['estados'];
		  $("#estado").html("<option disabled selected>Selecione um Estado</option>");
	    x.forEach(function(y){
	      var t = $("#estado").append("<option value='"+y['sigla']+"'"+(editar && state != "" && state == y['nome'] ? "selected" : "")+">"+y['nome']+"</option>");
	      if(editar  && state != "" && state == y['sigla'])
	        $("#estado").val(y['sigla']);
	    });
	    if(editar && state != "") popularCidades();
	  }
  });
}

function popularCidades(){
  var estado = $("#estado").val();
  if(estado == "") return;
	$("#cidade").html("<option disabled selected>Carregando...</option>");
  $.getJSON({
    url: "api/estado_cidade/"+estado+".json",
	  success: function(x){
		  x = x['cidades'];
		  $("#cidade").html("<option disabled selected>Selecione uma Cidade</option>");
	    x.forEach(function(y){
	      $("#cidade").append("<option value='"+y+"' "+(editar && city != "" && city == y ? "selected" : "")+">"+y+"</option>");
	    });
	  }
  });
}

function removerImg(){
  $("#imagePreview").attr("src", "imagens/no-avatar.jpg");
  $("input[type='file']").val("");
}

$("#estado").change(function(){popularCidades();});
popularEstados();
</script>
<script type="text/javascript" src="js/api.js"></script>