<?php
include '../clases/productos.php';

$codigo = $_POST['codigo'];
$desc = $_POST['descripcion'];
$precio = $_POST['precio'];
$ex = $_POST['existencias'];
$estado = $_POST['estado'];
$iva = $_POST['iva'];
$data =$_POST['data'];
$id = $_POST['id'];
$action = $_POST['accion'];

//var_dump($desc);
$prod = new classProductos();

switch ($action) {
             case "registrar":
             $res = $prod->nuevoProducto($codigo, $desc, $precio, $ex, $estado, $iva);
             
             break; 
             case "tabla":
             $res = $prod->tablaProductos($data);
             echo json_encode($res);
             
             break; 
             case "editar":
             $res = $prod->editProductos($codigo, $desc, $precio, $ex, $iva,$id);
             
             break; 
             case "borrar":
             $res = $prod->deleteProductos($id);
                 
             break; 

             case "buscar":
             $res = $prod->buscarProductos($id);
             echo json_encode($res);   
             break;
            
         }


?>