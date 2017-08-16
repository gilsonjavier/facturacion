<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "factura.com"; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
               <!-- <img style="width: 50%;" src="logo.png" alt="Logo"><br> -->
                
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:15px;font-weight:bold">
				<br><?php 
                $sql_config=mysqli_query($con,"select * from config");
				$config=mysqli_fetch_array($sql_config);
				echo $config['nombre_empresa'];?></span><br> 
				NIT:<?php echo $config['nit'];?><br>
				Dirección:<?php echo $config['direccion_empresa'];?><br>
				Teléfono:<?php echo $config['telefono_empresa'];?><br>
				Correo: <?php echo $config['correo_empresa'];?>
                
            </td>
			<td style="width: 25%;text-align:right;">
			<?php echo "Fecha: ".date("d/m/Y");?>
			</td>
			
        </tr>
    </table>
  
	<br>
  
   <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-white'>Factura</th>
            <th style="width: 25%;text-align:center" class='midnight-white'>Fecha Facturación</th>
            <th style="width: 25%;text-align: center" class='midnight-white'>Cliente</th>
            <th style="width: 15%;text-align: center" class='midnight-white'>Vendedor</th>
            <th style="width: 13%;text-align: center" class='midnight-white'>Forma Pago</th>
            <th style="width: 17%;text-align: right" class='midnight-white'>Total Factura</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "SELECT 
  `facturas`.`id_factura`,
  `facturas`.`numero_factura`,
  `facturas`.`fecha_factura`,
  `facturas`.`condiciones`,
  `facturas`.`total_venta`,
  `cliente`.`nombres` as cliente,
  `users`.`firstname` as vendedor
FROM
  `users`
  INNER JOIN `facturas` ON (`users`.`user_id` = `facturas`.`id_vendedor`)
  INNER JOIN `cliente` ON (`facturas`.`id_cliente` = `cliente`.`id_cliente`) where fecha_factura between '".$fecha_1."' and '".$fecha_2."'");
while ($row=mysqli_fetch_array($sql))
	{
	$numero=$row["numero_factura"];
	$fecha=$row['fecha_factura'];
	$cliente=$row['cliente'];
	$vendedor=$row['vendedor'];
	$condiciones = $row['condiciones'];
	$precio_venta=$row['total_venta'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	//$sumador_total+=$precio_total_r;//Sumador
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}


	?>

        <tr>
            <td border="1" class='<?php echo $clase;?>' style="width: 10%; text-align: right"><?php echo $numero; ?></td>
            <td class='<?php echo $clase;?>' style="width: 25%; text-align: center"><?php echo $fecha;?></td>
            <td class='<?php echo $clase;?>' style="width: 25%; text-align: center"><?php echo $cliente;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: center"><?php echo $vendedor;?></td>
            <td class='<?php echo $clase;?>' style="width: 13%; text-align: center"><?php if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia";}
				elseif ($condiciones==4){echo "Crédito";}?></td>
            <td class='<?php echo $clase;?>' style="width: 17%; text-align: right">$ <?php echo $precio_venta_r;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	//$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
	
	$nums++;
	}
	$sql_config=mysqli_query($con,"select * from config");
	$res=mysqli_fetch_array($sql_config);

	$sql_total=mysqli_query($con,"select sum(total_venta) as total from facturas where fecha_factura between '".$fecha_1."' and '".$fecha_2."'");
	$res_total=mysqli_fetch_array($sql_total);

    $iva_config = $res['iva'];
    $resultado_total = $res_total['total'];
	$total=number_format($resultado_total,2,'.','');
	$total_iva=($resultado_total  * $iva_config )/100;
    $subtotal = $resultado_total - $total_iva;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;
?>

      <tr>
      	
      	<td colspan="3" style="widtd: 85%; height:5%; text-align: right;"></td>
      	     </tr>
      	         <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL FACTURAS &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,0);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,0);?></td>
        </tr>
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL FACTURAS &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,0);?></td>
        </tr>
    </table>
	
	
	
	<br>
	<!--<div style="font-size:8pt;text-align:center;"><?php //echo $res['pie_pagina']; ?></div>
	
	
	  

</page>

<?php
/*$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO facturas VALUES ('','$numero_factura','$date','$id_cliente','$id_vendedor','$condiciones','$total_factura','1')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");*/
?>