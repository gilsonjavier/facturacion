function tabla(data){
$.ajax({

	url:"../controllers/control_clientes.php",
	type:"POST",
	dataType: "json",
	data:{accion:"tabla", data:data},
})
.done(function(res) {
        // console.log(res);  
         $("#contenido").html(res);    
        
    });

}

function eliminar(id){ 
	bootbox.confirm("Desea eliminar el registro?", function(result) {
 if(result){
$.ajax({
              url: "../controllers/control_clientes.php",
              type: "POST",
              dataType: "json",
              data: {accion:"borrar",
                     id:id},
          })
      .done(function() {         
        
    });
      bootbox.alert("Se elimino el registro con exito", function(){ 
                                 tabla("")
                                })
  }
})
}

function editar(id)
{	
	
	$.ajax({    url: "../controllers/control_clientes.php",
              type: "POST",
              dataType: "json",
              data: {accion:"buscar",
                     id:id},
          })
      .done(function(data) {
      //console.log(data) 
    $("#modal_id").val(data.id_cliente);
    $("#modal_nombres").val(data.nombres);
	$("#modal_identificacion").val(data.identificacion);
	$("#modal_direccion").val(data.direccion);
	$("#modal_telefono").val(data.telefono);
	$("#modal_correo").val(data.correo);
        
    });
      

     
}

$(document).ready(function() {
$('#nombres').focus();
$('#nombres').select();
//$('#save').prop('disabled', true);
var valor;
tabla();

 (function($) {
    $.fn.onEnter = function(func) {
        this.bind('keypress', function(e) {
            if (e.keyCode == 13) func.apply(this, [e]);    
        });               
        return this; 
     };
})(jQuery);


function guardarDatos()
{

  if($('#nombres').val() == "" || $('#identificacion').val() == "")
  {
    bootbox.alert("Hay Campos Obligatorios", function(){ 
                                
                                })
  }
  else
  {
	$.ajax({
    url: "../controllers/control_clientes.php",
    type: "POST",
    dataType: "json",
    data: {accion:"registrar",
    nombres:$('#nombres').val(), 
    identificacion:$('#identificacion').val(),
    tipo_cliente:$('#tipoId').val(),
    direccion:$('#direccion').val(),
    telefono:$('#telefono').val(),
    correo:$('#correo').val(),
    estado:1},
          })
      .done(function() {               
             });
       	 bootbox.alert("Se guardo el registro con exito", function(){ 
                                tabla()   
                                })
       	 $('#nombres').val("") 
         $('#identificacion').val("")
         $('#tipo_cliente').val("0")
         $('#direccion').val("")
         $('#telefono').val("")
         $('#correo').val("")
       }

}

$("select#tipo").on("change keyup on paste", function(){
    var value = $(this).val();
    $("#tipoId").val(value)

})

$('#nombres').onEnter(function(){  
    $('#identificacion').select();    
    });

$('#identificacion').onEnter(function(){  
    $('#direccion').select();    
    });

$('#direccion').onEnter(function(){  
    $('#telefono').select();    
    });

$('#telefono').onEnter(function(){  
    $('#correo').select();
   // $('#save').prop('disabled', false);    
    });

$('#correo').onEnter(function(){  
    guardarDatos()   
    });


function mayusculas(field){
$(function() {
    $(field).keyup(function() {
        this.value = this.value.toUpperCase();
    });
});
}

mayusculas('#nombres')
mayusculas('#direccion')
mayusculas('#correo')


$('#buscar').keyup(function () {      
            var value = $(this).val();    
            tabla(value)
            }) 



 $("#save").click(function(){
 guardarDatos()	
})   

})