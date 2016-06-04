///@author: jvhti@hotmail.com

if (typeof jQuery === 'undefined') {
  throw new Error('Index requer jQuery');
}

function mostrarAlert(cod){
  if(cod == 1){
    var alert = "<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"$('#recuperar').modal('hide');\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Sucesso!</strong> Um email contendo a nova senha foi enviado para você. <a href=\"#\" onclick=\"$('#recuperar').modal('hide'); $('#login').modal('show');\">Click aqui</a> para fazer login.</div>";
    $("#alertArea_recuperar").html(alert);
  }
}