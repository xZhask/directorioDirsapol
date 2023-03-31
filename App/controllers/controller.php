<?php
require_once '../models/ClsIpress.php';

$accion = $_POST['accion'];
controller($accion);

function controller($accion)
{
    $objIpress = new ClsIpress();

    switch ($accion) {
        case 'LISTAR_UNIDADES':
            $listadoUnidades = $objIpress->ListarIpress();
            $listadoUnidades = $listadoUnidades->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($listadoUnidades);
            break;
        case 'PRUEBA':
            $otros = json_decode($_POST['otros']);
            $respuesta = ['rpta' => 'ok', 'data' => $otros];
            echo json_encode($respuesta);
            break;
    }
}
