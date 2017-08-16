		$(document).ready(function(){
			
		
		$('#save').click(function(){

		/*	var date = moment($('#fecha1').val()+ ' ' + $('#inicio').val(), "YYYY-MM-DD HH:mm");
            var date1 = moment($('#fecha2').val()+ ' ' + $('#fin').val(), "YYYY-MM-DD HH:mm");  */

            var date = $('#fecha1').val()+ ' ' + $('#inicio').val();
            var date1 = $('#fecha2').val()+ ' ' + $('#fin').val();
        mostrarVentana('pdf/documentos/ver_factura.php?fecha1='+date+'&fecha2='+date1,'Factura','','1024','768','true');

		})
			
		
})