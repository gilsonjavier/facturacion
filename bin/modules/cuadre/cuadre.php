<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
        ?>

<!DOCTYPE html>
<html>
<head><title>Reportes</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../../lib/css/general.css"> 
  <link rel="stylesheet" type="text/css" href="../../../lib/bootstrap/css/bootstrap.css"> 
	<script src="../../../lib/jquery/jquery-2.2.3.min.js"></script>
  <script src='js/cuadre.js'></script>
  <script src='js/fechaHora.js'></script>
  <script src='js/mostrarVentana.js'></script>
  <script  src = '../../../lib/clockpicker/clockpicker.js' ></script> 
     <link href="../../../lib/clockpicker/clockpicker.css" rel="stylesheet" />
     <script  src = '../../../lib/moment.min.js' ></script> 
     <link rel="stylesheet" href="../../../lib/menu/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../../lib/menu/dist/css/skins/_all-skins.min.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/iCheck/flat/blue.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/datepicker/datepicker3.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   
     <script src="../../../lib/jquery-ui.min.js"></script>
     <script src="../../../lib/menu/plugins/knob/jquery.knob.js"></script>

     <link rel="stylesheet" href="../../../css/jquery-ui.css">
 <!-- <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
   
     <script src="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
     <script src="../../../lib/menu/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <script src="../../../lib/menu/plugins/fastclick/fastclick.js"></script>
     <script src="../../../lib/menu/dist/js/app.min.js"></script>
     <script src="../../../lib/menu/dist/js/demo.js"></script>
     <link rel="stylesheet" href="../../../lib/css/awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../lib/css/ionicons.min.css">
  <script src="../../../lib/bootbox.min.js"></script>
  <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
<link type="text/css" href="../../../lib/datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="../../../lib/datatable/js/jquery.dataTables.js"></script>


</head>
<body>


<?php
include '../../../plantilla/plantilla1.php';
?> 



<div class="panel panel-default">
   <div class="panel-heading">
     <h3 class="panel-title">Reporte Facturas</h3>
  </div>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">


    <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="fin">
       Fecha inicial
      </label>
      <input class="form-control fecha" id="fecha1" name="1" type="text"/>
     </div>
     </div>

  
  <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="inicio">
       Hora
      </label>
      <input class="form-control time" id="inicio" name="inicio" type="text"/>
     </div>
     </div>


     <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="fin">
       Fecha Final
      </label>
      <input class="form-control fecha" id="fecha2" name="2" type="text"/>
     </div>
     </div>

     <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="fin">
       Hora
      </label>
      <input class="form-control time" id="fin" name="fin" type="text"/>
     </div>
     </div>

     <div class="col-md-1"> 
     <div class="form-group">
      <div>
       <button class="btn btn-primary " id= "save" name="save" type="submit">
        Enviar
       </button>
      </div>
      </div>
     </div>
 
 
  </div>
 </div>
</div>
</div>

</div>


<?php
include '../../../plantilla/footer.php';
?>


</body>
</html>


