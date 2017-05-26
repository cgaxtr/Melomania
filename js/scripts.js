  $(document).ready(function(){
    $("#destinatario").autocomplete({
      source: 'modelo/usuariosHandler.php',
      minLength: 1
    });

    $( "#datepicker" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0"
    });

  });
