<!DOCTYPE html>
<html>
<head><title>Clientes</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../../lib/css/general.css"> 
  <link rel="stylesheet" type="text/css" href="../../../lib/bootstrap/css/bootstrap.css"> 
	<script src="../../../lib/jquery/jquery-2.2.3.min.js"></script>
  <script src='js/clientes.js'></script>
  <script src='js/tabla.js'></script>
  <script src='js/modalEditarClientes.js'></script>
  <script src='js/validar.js'></script>

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
     <h3 class="panel-title">Registrar Clientes</h3>
  </div>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
  
   <div class="col-md-5">
     <div class="form-group ">
      <label class="control-label " for="nombres">
       Nombre Completo
      </label>
      <input class="form-control" id="nombres" name="nombres" type="text"/>
     </div>
         </div>
 <div class="col-md-4">
     <div class="form-group ">
      <label class="control-label " for="identificacion">
       Identificacion
      </label>
      <input class="form-control" id="identificacion" name="identificacion" type="text"/>
     </div>
     </div>

      <div class="col-md-3">
     <div class="form-group ">
      <label class="control-label " for="tipo">
       Tipo Cliente
      </label>
      <select id = "tipo" class="form-control">
        <option value = "1">Persona Natural</option>
        <option value = "2">Persona Juridica</option>
      </select>
     </div>
      </div>
<input class="form-control" id="tipoId" name="tipoId" value="1" type="hidden"/>
     <div class="col-md-4"> 
     <div class="form-group ">
      <label class="control-label " for="direccion">
       Direccion
      </label>
      <input class="form-control" id="direccion" name="direccion" type="text"/>
     </div>
     </div>

     <div class="col-md-3"> 
     <div class="form-group ">
      <label class="control-label " for="telefono">
       Telefono
      </label>
      <input class="form-control" id="telefono" name="telefono" type="text"/>
     </div>
     </div>
   
   <div class="col-md-4"> 
     <div class="form-group ">
      <label class="control-label " for="correo">
       Correo
      </label>
      <input class="form-control" id="correo" name="correo" type="text"/>
     </div>
     </div>



     <div class="col-md-1"> 
     <div class="form-group">
      <div>
       <button class="btn btn-primary " id= "save" name="save" type="submit">
        Guardar
       </button>
      </div>
      </div>
     </div>
 
 
  </div>
 </div>
</div>
</div>
<div class="panel panel-default">
   <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;"></h4>
                <div class="input-group">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar clientes">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                      <!--  <button class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i></button>-->
                    </div>
                </div>
        </div></div>


<div id="contenido"></div>
</div>


<?php
include '../../../plantilla/footer.php';
?>
<?php
include 'modal_editarClientes.php';
?>

</body>
</html>


