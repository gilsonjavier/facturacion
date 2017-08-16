<?php
include '../clases/sistema.php';

$nombres = $_POST['nombres'];
//$identificacion = $_POST['identificacion'];
$nit = $_POST['nit'];
$direccion = $_POST['direccion'];
$iva = $_POST['iva'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$pie =$_POST['pie'];
$id = $_POST['id'];
$action = $_POST['accion'];

//var_dump($desc);
$prod = new classSistema();

switch ($action) {
             
             case "select":
             $res = $prod->selectConfig();
             echo json_encode($res);
             
             break; 
             case "editar":
             $res = $prod->editConfig($nombres,$direccion, $telefono, $correo,$nit,$iva,$pie);             
             break;              
            
         }


?>