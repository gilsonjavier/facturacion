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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
	<script src="../../../lib/jquery/jquery-2.2.3.min.js"></script>
	<link rel="stylesheet" href="../../../lib/menu/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../../lib/menu/dist/css/skins/_all-skins.min.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/iCheck/flat/blue.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/datepicker/datepicker3.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   
     <script src="../../../lib/jquery-ui.min.js"></script>
     <script src="../../../lib/menu/plugins/knob/jquery.knob.js"></script>
   
     <script src="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
     <script src="../../../lib/menu/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <script src="../../../lib/menu/plugins/fastclick/fastclick.js"></script>
     <script src="../../../lib/menu/dist/js/app.min.js"></script>
     <script src="../../../lib/menu/dist/js/demo.js"></script>
     <link rel="stylesheet" href="../../../lib/css/awesome.min.css">
     <link rel="stylesheet" href="../../../lib/css/ionicons.min.css">

  </head>
  <body>
	<?php
	include("../../../plantilla/plantilla1.php");
	?>  
   <!-- <div class="container">-->
		<div class="panel panel-default">
		<div class="panel-heading">
		   <div class="btn-group pull-right">
				<!--<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>-->
			</div>
			<h4> Administrar Facturas</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-3 control-label"># de Factura o Cliente</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="" onkeyup='load(1);'>
							</div>						
							
							<div class="col-md-3">
								<!--<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>-->
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div>
				<div class='outer_div'></div>
			</div>
		</div>	
		
	<!--</div>-->
	<hr>
	<?php
	include("footer.php");
	include '../../../plantilla/footer.php';
	?>
	<script type="text/javascript" src="js/printWindow.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
	<script src="../../../lib/bootbox.min.js"></script>
  <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  </body>
</html>