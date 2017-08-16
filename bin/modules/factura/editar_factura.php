<?php
session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
		exit;
        }
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Factura";

	require_once ("../../../config/db.php");
	require_once ("../../../config/conexion.php");
	
	if (isset($_GET['id_factura']))
	{

		$id_factura=intval($_GET['id_factura']);
		$campos="cliente.id_cliente, cliente.nombres, cliente.telefono, cliente.correo, facturas.id_vendedor, facturas.fecha_factura, facturas.condiciones, facturas.estado_factura, facturas.numero_factura";
		$sql_factura=mysqli_query($con,"select $campos from facturas, cliente where facturas.id_cliente=cliente.id_cliente and id_factura='".$id_factura."'");
		$count=mysqli_num_rows($sql_factura);
		
		if ($count==1)
		{
				$rw_factura=mysqli_fetch_array($sql_factura);
				$id_cliente=$rw_factura['id_cliente'];
				$nombre_cliente=$rw_factura['nombres'];
				$telefono_cliente=$rw_factura['telefono'];
				$email_cliente=$rw_factura['correo'];
				$id_vendedor_db=$rw_factura['id_vendedor'];
				$fecha_factura=date("d/m/Y", strtotime($rw_factura['fecha_factura']));
				$condiciones=$rw_factura['condiciones'];
				$estado_factura=$rw_factura['estado_factura'];
				$numero_factura=$rw_factura['numero_factura'];
				$_SESSION['id_factura']=$id_factura;				
				//var_dump($_SESSION['id_factura']);
				$_SESSION['numero_factura']=$numero_factura;
		}	
		else
		{
			header("location: facturas.php");
			exit;	
		}
	} 
	else 
	{
		header("location: facturas.php");
		exit;
	}
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
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" required value="<?php echo $nombre_cliente;?>">
					  <input id="id_cliente" name="id_cliente" type='hidden' value="<?php echo $id_cliente;?>">
				  </div>
				<!--  <label for="tel1" class="col-md-1 control-label">Teléfono</label>-->
							<div class="col-md-2">
								<input type="hidden" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								
								<select class='form-control input-sm ' id="condiciones" name="condiciones">
									<option value="1" <?php if ($condiciones==1){echo "selected";}?>>Efectivo</option>
									<option value="2" <?php if ($condiciones==2){echo "selected";}?>>Cheque</option>
									<option value="3" <?php if ($condiciones==3){echo "selected";}?>>Transferencia bancaria</option>
									<option value="4" <?php if ($condiciones==4){echo "selected";}?>>Crédito</option>
								</select>



								<input type="hidden" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
				 </div>

                          <!--  <div class="col-md-2">
								<select class='form-control input-sm ' id="estado_factura" name="estado_factura">
									<option value="1" <?php if ($estado_factura==1){echo "selected";}?>>Pagado</option>
									<option value="2" <?php if ($estado_factura==2){echo "selected";}?>>Pendiente</option>
								</select>
							</div>-->


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
							<label for="email" class="col-md-1 control-label"></label>

							<!--<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>-->



							<div class="col-md-3">
								<button type="button" class="btn btn-primary" onclick="imprimir_factura('<?php echo $id_factura;?>')">
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
		</div></div></div><!--</div></div> Carga los datos ajax -->	
    
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/printWindow.js"></script>
	<script type="text/javascript" src="js/editar_factura.js"></script>
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