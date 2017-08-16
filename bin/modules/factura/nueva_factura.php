<?php
session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
		exit;
        }
	$active_new="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Factura";
	

	require_once ("../../../config/db.php");
	require_once ("../../../config/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
    
  </head>
  <body>
	<?php
	include("../../../plantilla/navbar.php");
	?>  
    <!--<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Nueva Factura</h4>
		</div>
		<div class="panel-body">-->
		<?php 
			include("registro_clientes.php");
			include("registro_productos.php");
		?>
		
		
           <div id="datos_fact" class="container">
           	<div class="panel panel-primary">
		<div class="panel-heading">
			<i class='glyphicon glyphicon-edit'></i> Datos Factura
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-2 control-label">Cliente</label>
				  <div class="col-md-4">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" required>
					  <input id="id_cliente" type='hidden'>	
				  </div>
				<!--  <label for="tel1" class="col-md-1 control-label">Teléfono</label>-->
							<div class="col-md-2">
								<input type="hidden" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>



								<input type="hidden" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-2 control-label">Vendedor</label>
							<div class="col-md-4">
								<select class="form-control input-sm" id="id_vendedor">
									<?php
										$sql_vendedor=mysqli_query($con,"select * from users order by lastname");
										while ($rw=mysqli_fetch_array($sql_vendedor)){
											$id_vendedor=$rw["user_id"];
											$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
											if ($id_vendedor==$_SESSION['user_id']){
												$selected="selected";
											} else {
												$selected="";
											}
											?>
											<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
											<?php
										}
									?>
								</select>
							</div>
							<!--<label for="tel2" class="col-md-1 control-label">Fecha</label>-->
							<div class="col-md-2">
								<input type="hidden" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label">    </label>
							<div class="col-md-3">

								<button type="submit" class="btn btn-primary">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
								
							</div>
						</div>
				
				<center><h4><strong>Adicionar Productos</strong></h4></center>
            <?php 
			include("buscar_productos.php");
			?>
				
			</form></div></div></div>

				</div>
     



		<div id="grilla_articulos" class="container">	
			<!--<div class="container">-->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<i class='glyphicon glyphicon-edit'></i> Detalles Factura
		</div>
		<div class="panel-body">
			<div class="col-md-12">
					<div class="pull-right">
					<!--	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>-->
					</div>	
				</div>

<div id="resultados" class='col-md-12' style="margin-top:10px"></div>
		</div></div>
<div class="panel panel-primary">
		<div class="panel-heading">
			<i class='glyphicon glyphicon-edit'></i> Ubicacion
		</div>
		<!-- MAPA -->
<div  width="10000000" height="100000"><iframe src="https://www.google.com/maps/d/embed?mid=1Jv1GeVsckAMW0rBldn1rXNip4uw&ll=-0.9735521434024857%2C-80.7035278677368&z=14"  width="100%" height="350" data-wow-duration="1000ms" data-wow-delay="400ms"></iframe></div>
<!-- //MAPA -->

		</div><!--</div></div> Carga los datos ajax -->	
    
	<hr>

	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/printWindow.js"></script>
	<script type="text/javascript" src="js/nueva_factura.js"></script>
	<link rel="stylesheet" href="../../../css/jquery-ui.css">
    <script src="../../../lib/jquery-ui.js"></script>

	<script>
		$(function() {
						$("#nombre_cliente").autocomplete({
							source: "../clases/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombres);
								$('#tel1').val(ui.item.telefono);
								$('#mail').val(ui.item.correo);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>