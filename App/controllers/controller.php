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
            $jefeIpress = [
                'nombre' => $_POST['nombreJefeIpress'],
                'grado' => $_POST['gradoJefeIpress'],
                'telefono' => $_POST['telefonoJefeIpress']
            ];
            $jefeArea = [
                'nombre' => $_POST['nombreJefe'],
                'grado' => $_POST['gradoJefe'],
                'telefono' => $_POST['telefonoJefe']
            ];
            $otros = json_decode($_POST['otros']);
            $otroContacto1 = [
                'nombre' => $otros[0]->{'nombre'},
                'grado' => $otros[0]->{'grado'},
                'telefono' => $otros[0]->{'phone'},
                'cantidad' => count($otros),
            ];

            $respuesta = ['rpta' => 'ok', 'JefeIpress' => $jefeIpress, 'JefeArea' => $jefeArea, 'otrosContactos' => $otros, 'Contact01' => $otroContacto1];
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
