function datos_config(){
$.ajax({

	url:"../controllers/control_sistema.php",
	type:"POST",
	dataType: "json",
	data:{accion:"select"},
})
.done(function(data) {
        $("#nombre_empresa").val(data.nombre_empresa);
        $("#nit").val(data.nit);
        $("#direccion_empresa").val(data.direccion_empresa);
        $("#telefono").val(data.telefono_empresa);
        $("#correo").val(data.correo_empresa);
        $("#iva").val(data.iva);   
        $("#pie").val(data.pie_pagina);          
    });

}

$(document).ready(function() {
datos_config();

function guardarDatos()
{
	$.ajax({
    url: "../controllers/control_sistema.php",
    type: "POST",
    dataType: "json",
    data: {accion:"editar",
    nombres:$("#nombre_empresa").val(),
    nit:$("#nit").val(),
    direccion:$("#direccion_empresa").val(),
    telefono:$('#telefono').val(),
    correo:$('#correo').val(),
    iva:$('#iva').val(),
    pie:$('#pie').val() },
          })
      .done(function() {               
             });
       	 bootbox.alert("Se editaron los datos con exito", function(){ 
                                 datos_config() 
                                })
      

}



function mayusculas(field){
$(function() {
    $(field).keyup(function() {
        this.value = this.value.toUpperCase();
    });
});
}

mayusculas('#nombre_empresa')
mayusculas('#direccion_empresa')
mayusculas('#correo')





 $("#save").click(function(){
 guardarDatos()	
})   

})