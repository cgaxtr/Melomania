$(document).ready(function(){
  $.ajax({
    type: "POST",
    url: 'modelo/gruposHandler.php',
    data: {'id': $("select").attr("id")},
    dataType:'json',
    success: function(data) {
       var select = $("select[name='grupo']"), options = '';
       select.empty();

       for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i]["nombre"]+"'>"+ data[i]["nombre"] +"</option>";
       }

       select.append(options);
    }
  });
});
