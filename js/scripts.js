  $(document).ready(function(){
    $("#destinatario").autocomplete({
      source: 'modelo/usuariosHandler.php',
      minLength: 1
    });
  });
