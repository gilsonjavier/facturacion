<?php
	include('../../../is_logged.php');
	require_once ("../../../config/db.php");
	require_once ("../../../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo', 'descripcion');//Columnas de busqueda
		 $sTable = "productos";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		include 'pagination.php'; 

		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive table-striped" >
			  <table class="table">
				<tr>
					<!--<th>Código</th>-->
					<th>Producto</th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Precio</span></th>
					<th class='text-lefth' style="width: 36px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo'];
					$nombre_producto=$row['descripcion'];
					$precio_venta=$row["precio"];
					//$precio_venta=number_format($precio_venta,2);
					?>
					<tr>
						<!--<td><?php echo $codigo_producto; ?></td>-->
						<td><?php echo $nombre_producto; ?></td>
						<td class='col-xs-2'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"  value="1">
						</div></td>
						<td class='col-xs-3'><div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" disabled>
						</div></td>
						<td class='text-center'><a class='btn btn-info' href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-hand-right"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>