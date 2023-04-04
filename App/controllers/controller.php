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
        case 'LOGIN':
            $pass = $_POST['pass'];
            $datosIpress = $objIpress->validarLogin($_POST['unidad']);
            if ($datosIpress->rowCount() > 0) {
                $datosIpress = $datosIpress->fetch(PDO::FETCH_OBJ);
                $clave = $datosIpress->clave;
                if (password_verify($pass, $clave)) {
                    session_start();
                    $_SESSION['active'] = true;
                    $_SESSION['idIpress'] = $datosIpress->idIpress;
                    //$_SESSION['emailIpress'] = $datosIpress->emailIpress;
                    //$_SESSION['emailEst'] = $datosIpress->emailEstadistica;
                    $_SESSION['nombreIpress'] = $datosIpress->nombreIpress;
                    $rpta = 'success';
                    $mensaje = 'ok';
                } else {
                    $rpta = 'fail';
                    $mensaje = 'contraseña no es correcta';
                }
            } else {
                $rpta = 'fail' . $_POST['unidad'];
                $mensaje = 'No existe registro con estos datos';
            }
            $respuesta = ['rpta' => $rpta, 'data' => $mensaje];
            echo json_encode($respuesta);
            break;
    }
}
