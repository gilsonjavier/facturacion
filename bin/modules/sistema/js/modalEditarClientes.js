$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "../controllers/control_clientes.php",
    type: "POST",
    dataType: "json",
    data: {accion:"editar",
    id:$('#modal_id').val(),
    nombres:$('#modal_nombres').val(), 
    identificacion:$('#modal_identificacion').val(),
    direccion:$('#modal_direccion').val(),
    telefono:$('#modal_telefono').val(),
    correo:$('#modal_correo').val()},
          })
      .done(function() {               
             });
      $('#myModal').modal('toggle');
      parent.tabla("")   
    });



})