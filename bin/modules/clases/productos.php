<?php 
 include '../../../core.php';
 include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Productos extends ADOdb_Active_Record{}

class classProductos
{


 public function nuevoProducto($codigo, $desc, $precio, $ex, $estado, $iva)
 { 
 
 $prod = new Productos('productos');
 
 $prod->codigo = $codigo;  
 $prod->descripcion = $desc;  
 $prod->precio = $precio;  
 $prod->existencias = $ex; 
 $prod->estado = $estado; 
 $prod->iva = $iva;
 $prod->save();
 //var_dump($usuario); 
 }


 function tablaProductos($data)
	{
		$db = App::$base;
	  
       $sql = "SELECT 
  `productos`.`id_producto`,
  `productos`.`codigo`,
  `productos`.`descripcion`,
  CONCAT('$ ', FORMAT(`productos`.`precio`, 0)) AS precio,
  `productos`.`existencias`,
  CONCAT(`productos`.`iva`, ' %') AS iva,
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
               </div>
                \" 
               as borrar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as buttons                    
            FROM
            `productos`
            WHERE descripcion like lower('%$data%') or codigo like '%$data%'
            limit 5";

		$rs = $db->dosql($sql, array());
        $tabla = '<table id="example" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">Codigo</th>
                        <th id="yw9_c1">Producto</th>
                        <th id="yw9_c2">Precio</th>
                        <th id="yw9_c3">Existencias</th>
                        
                        <th id="yw9_c5">Edit</th>
                        <th id="yw9_c6">Delete</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['precio']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['existencias']).'
                            </td> 
                           
                            <td width= "30" onclick="editar('.$rs->fields['id_producto'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>

                            <td onclick="eliminar('.$rs->fields['id_producto'].')">                            
                                '.utf8_encode($rs->fields['buttons']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;
	}

	public function editProductos($codigo,$descripcion,$precio,$existencias,$iva,$id)
	{

		$db = App::$base;
        $sql = "UPDATE `inv`.`productos` 
                SET `codigo`= $codigo, 
                    `descripcion`='$descripcion', 
                    `precio`=$precio, 
                    `existencias`=$existencias, 
                    `iva`=$iva
                WHERE `id_producto`= $id ";
		$rs = $db->dosql($sql, array());
       //var_dump($sql);
	}

	public function deleteProductos($id)
	{
		$db = App::$base;
        $sql = "DELETE FROM `inv`.`productos` 
                WHERE `id_producto`=$id ";
		$rs = $db->dosql($sql, array());

	}

	public function buscarProductos($id)
	{
		$db = App::$base;
        $sql = "SELECT 
  `productos`.`id_producto`,
  `productos`.`codigo`,
  `productos`.`descripcion`,
  `productos`.`precio`,
  `productos`.`existencias`,
  `productos`.`iva`
FROM
  `productos`
                WHERE `id_producto`= $id ";
		$rs = $db->dosql($sql, array());

		while (!$rs->EOF) 
                   {

                   	$res = array("id_producto" => $rs->fields['id_producto'],
                   		            "codigo" => $rs->fields['codigo'],
                   		            "descripcion" => $rs->fields['descripcion'],
                   		            "precio" => $rs->fields['precio'],
                   		            "existencias" => $rs->fields['existencias'],
                   		            "iva" => $rs->fields['iva']);

                   	$rs->MoveNext();	    
                   } 
                   return $res;

	}

 
 } 

?>