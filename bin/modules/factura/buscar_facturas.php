<?php
	include('../../../is_logged.php');	
	require_once ("../../../config/db.php");
	require_once ("../../../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong></strong> Se elimino la Factura con exito
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong></strong> No se puedo eliminar la factura
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "facturas, cliente, users";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.id_cliente=cliente.id_cliente and facturas.id_vendedor=users.user_id";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (cliente.nombres like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = 'facturas.php';
		
		$sql="SELECT * FROM  $sTable $sWhere LIMIT 7";
		$query = mysqli_query($con, $sql);
		
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-condensed">
				<tr>
					<th>No</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Estado Factura</th>
					<th class='text-right'>Total Factura</th>
					<th class='text-right'>Accion</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombres'];
						$telefono_cliente=$row['telefono'];
						$email_cliente=$row['correo'];
						$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$estado_factura=$row['estado_factura'];
						if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
					?>
					<tr>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $telefono_cliente;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_cliente;?>" ><?php echo $nombre_cliente;?></a></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
					<td class="text-right">
						<a target= "_blank" href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-info' title='Editar factura' ><i class="glyphicon glyphicon-pencil"></i></a> 
						<a href="#" class='btn btn-primary' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-print"></i></a> 
						<a href="#" class='btn btn-danger' title='Borrar factura' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>