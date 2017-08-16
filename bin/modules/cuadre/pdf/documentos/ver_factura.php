<?php
session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../../../../config/db.php");
	include("../../../../../config/conexion.php");
	$f1= $_GET['fecha1'];
	$f2= $_GET['fecha2'];

	$date1=date_create($f1);
	$fecha_1= date_format($date1,"Y/m/d H:i:s ");

	$date=date_create($f2);
	$fecha_2= date_format($date,"Y/m/d H:i:s ");
	var_dump($fecha1);
	//$sql_count=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$sql_count=mysqli_query($con,"select * from facturas where fecha_factura between '".$fecha_1."' and '".$fecha_2."'");
	
	$count=mysqli_num_rows($sql_count);

	if ($count==0)
	{
	echo "<script>alert('No hay datos para mostrar')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from facturas where fecha_factura between '".$fecha_1."' and '".$fecha_2."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	//var_dump($rw_factura);
	/*$numero_factura=$rw_factura['numero_factura'];
	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$condiciones=$rw_factura['condiciones'];
	require_once(dirname(__FILE__).'/../html2pdf.class.php');*/
    // get the HTML
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
?>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:left" class='midnight-white'>#</th>
            <th style="width: 60%;text-align:center" class='midnight-white'>fecha</th>
            <th style="width: 15%;text-align: right" class='midnight-white'>Cliente</th>
            <th style="width: 15%;text-align: right" class='midnight-white'>Usuario</th>
            <th style="width: 15%;text-align: right" class='midnight-white'>Total</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from facturas where fecha_factura between '".$fecha_1."' and '".$fecha_2."'");
while ($row=mysqli_fetch_array($sql))
	{
	$numero=$row["numero_factura"];
	$fecha=$row['fecha_factura'];
	$cliente=$row['id_cliente'];
	$vendedor=$row['id_vendedor'];
	
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
            <td border="0" class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $numero; ?></td>
            <td class='<?php echo $clase;?>' style="width: 30%; text-align: left"><?php echo $fecha;?></td>
            <td class='<?php echo $clase;?>' style="width: 30%; text-align: right"><?php echo $cliente;?></td>
            <td class='<?php echo $clase;?>' style="width: 30%; text-align: right"><?php echo $vendedor;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_r;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	//$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
	
	$nums++;
	}
/*	$sql_config=mysqli_query($con,"select * from config");
	$res=mysqli_fetch_array($sql_config);
    $iva_config = $res['iva'];
    //var_dump($iva_config);
	$total=number_format($sumador_total,2,'.','');
	$total_iva=($total * $iva_config )/100;
    $subtotal = $total - $total_iva;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;*/
?>
	  
     <!-- <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,0);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA  &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,0);?></td>
        </tr>
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,0);?></td>
        </tr>-->
    </table>
    <?php
     ob_start();




     include(dirname('__FILE__').'/res/ver_factura_html.php');





     
   $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        ob_end_clean() ;
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>