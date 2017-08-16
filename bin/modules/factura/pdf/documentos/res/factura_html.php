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
             <!--   <img style="width: 50%;" src="logo.png" alt="Logo"><br>-->
                
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
			<td style="width: 25%;text-align:right">
			FACT - <?php echo $numero_factura;?>
			</td>
			
        </tr>
    </table>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-black'></td>
        </tr>
		<tr>
           <td style="width:70%;" >
			<?php 
          
				$sql_cliente=mysqli_query($con,"select * from cliente where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				
				echo "Nombre Cliente: ",$rw_cliente['nombres'];
				echo "<br>";
				echo "Direccion: ", $rw_cliente['direccion'];
				echo "<br>";
				echo "Telefono: ", $rw_cliente['telefono'];
				/*echo "<br> Email: ";
				echo $rw_cliente['correo'];*/
				echo "<br>";	
				echo "Vendedor: ", $rw_user['firstname']." ".$rw_user['lastname'];
			?>
			
		   </td>
		   <td style="width:40%;" >
				Forma de Pago: <?php 
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia";}
				elseif ($condiciones==4){echo "Crédito";}
				echo '<br>';
				echo "Fecha: ".date("d/m/Y");
				?>
				<br>

		   </td>
        </tr>
             
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-white'>CANT</th>
            <th style="width: 60%;text-align:center"  class='midnight-white'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-white'>VALOR UNIT</th>
            <th style="width: 15%;text-align: right" class='midnight-white'>VALOR TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from productos, tmp where productos.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['descripcion'];
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,0);
	$precio_venta_r=str_replace(",","",$precio_venta_f);
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,0);
	$precio_total_r=str_replace(",","",$precio_total_f);
	$sumador_total+=$precio_total_r;
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
	
	$nums++;
	}
	$sql_config=mysqli_query($con,"select * from config");
	$res=mysqli_fetch_array($sql_config);
    $iva_config = $res['iva'];
    //var_dump($iva_config);
	$total=number_format($sumador_total,2,'.','');
	$total_iva=($total * $iva_config )/100;
    $subtotal = $total - $total_iva;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;
?>
	  
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,0);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,0);?></td>
        </tr><tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,0);?></td>
        </tr>
    </table>
	
	
	
	<br>
	<div style="font-size:8pt;text-align:center;"><?php echo $res['pie_pagina']; ?></div>
	
	
	  

</page>

<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO facturas VALUES ('','$numero_factura','$date','$id_cliente','$id_vendedor','$condiciones','$total_factura','1')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");
?>