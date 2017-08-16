<?php 
 include '../../../core.php';
 include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Configuracion extends ADOdb_Active_Record{}

class classSistema
{


 

 function selectConfig()
	{
		$db = App::$base;
	  
       $sql = "SELECT * FROM config";

		$rs = $db->dosql($sql, array());
      
		          while (!$rs->EOF) 
                   {
                 $data = array('id_config' => $rs->fields['id_config'],
                               'nombre_empresa' => $rs->fields['nombre_empresa'],
                               'direccion_empresa' => $rs->fields['direccion_empresa'],
                               'telefono_empresa' => $rs->fields['telefono_empresa'],
                               'correo_empresa' => $rs->fields['correo_empresa'],
                               'nit' => $rs->fields['nit'],
                               'iva' => $rs->fields['iva'],
                               'pie_pagina' => $rs->fields['pie_pagina']);                               
	
	               $rs->MoveNext();	    
                   }              
      
        return $data;
	}

	public function editConfig($nom,$dir,$tel,$cor,$nit, $iva, $pie)
	{

		$db = App::$base;
        $sql = "UPDATE config 
                SET `nombre_empresa`= '$nom', 
                    `direccion_empresa`='$dir', 
                    `telefono_empresa`='$tel',
                    `correo_empresa`='$cor',
                    `nit`='$nit',
                    `iva`='$iva',
                    `pie_pagina`='$pie'
                WHERE `id_config`= 1";
		$rs = $db->dosql($sql, array());
      // var_dump($sql);
	}
 
 } 

?>