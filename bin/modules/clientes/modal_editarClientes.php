

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Productos</h4>
<br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
  
   
     <div class="form-group ">
      <label class="control-label " for="nombres">
       Nombre Completo
      </label>
      <input class="form-control" id="modal_nombres" name="nombres" type="text"/>
     </div>
       
 <input class="form-control" id="modal_id" name="id" type="hidden"/>
     <div class="form-group ">
      <label class="control-label " for="identificacion">
       Identificacion
      </label>
      <input class="form-control" id="modal_identificacion" name="identificacion" type="text"/>
     </div>
     

  
    <!-- <div class="form-group ">
      <label class="control-label " for="tipo">
       Tipo Cliente
      </label>
      <select id = "tipo" class="form-control">
        <option value = "1">Persona Natural</option>
        <option value = "2">Persona Juridica</option>
      </select>
     </div>-->
     
<input class="form-control" id="tipoId" name="tipoId" value="1" type="hidden"/>
   
     <div class="form-group ">
      <label class="control-label " for="direccion">
       Direccion
      </label>
      <input class="form-control" id="modal_direccion" name="direccion" type="text"/>
     </div>
     

    
     <div class="form-group ">
      <label class="control-label " for="telefono">
       Telefono
      </label>
      <input class="form-control" id="modal_telefono" name="telefono" type="text"/>
     </div>
     
   
  
     <div class="form-group ">
      <label class="control-label " for="correo">
       Correo
      </label>
      <input class="form-control" id="modal_correo" name="correo" type="text"/>
     </div>

  
    
 


        <div class="modal-footer">
          <button class="btn btn-primary " id= "btn_save" name="save" type="submit">Guardar Cambios</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


        </div>
      </div>
</div>

  </div>
