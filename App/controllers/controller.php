<?php
require_once '../models/ClsIpress.php';
require_once '../models/ClsContacto.php';

$accion = $_POST['accion'];
controller($accion);

function controller($accion)
{
    $objIpress = new clsIpress();
    $objContacto = new clsContacto();

    switch ($accion) {
        case 'LISTAR_UNIDADES':
            $listadoUnidades = $objIpress->ListarIpress();
            $listadoUnidades = $listadoUnidades->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($listadoUnidades);
            break;
        case 'REGISTRAR_CONTACTOS':
            session_start();
            $idIpress = $_SESSION['idIpress'];

            $datosEmails = [
                'emailEstadistica' => $_POST['correoArea'],
                'emailIpress' => $_POST['correoIpress'],
                'idIpress' => $idIpress,
            ];
            $objContacto->actualizarEmails($datosEmails);
            /* LIMPIAR CONTACTOS REGISTRADOS */
            $objContacto->limpiarContactos($idIpress);
            /* REGISTRO JEFE DE IPRESS */
            $jefeIpress = [
                'nombre' => $_POST['nombreJefeIpress'],
                'grado' => $_POST['gradoJefeIpress'],
                'telefono' => $_POST['telefonoJefeIpress'],
                'tipo' => 'J',
                'idIpress' => $idIpress,
            ];
            $objContacto->registrarContacto($jefeIpress);

            /* REGISTRO JEFE DE ÁREA */
            $jefeArea = [
                'nombre' => $_POST['nombreJefe'],
                'grado' => $_POST['gradoJefe'],
                'telefono' => $_POST['telefonoJefe'],
                'tipo' => 'A',
                'idIpress' => $idIpress,
            ];
            $objContacto->registrarContacto($jefeArea);

            /* REGISTRO JEFE DE OTROS CONTACTOS */
            $otros = json_decode($_POST['otros']);
            $cont = count($otros);
            for ($i = 0; $i < $cont; $i++) {
                $contacto = [
                    'nombre' => $otros[$i]->{'nombre'},
                    'grado' => $otros[$i]->{'grado'},
                    'telefono' => $otros[$i]->{'phone'},
                    'tipo' => 'O',
                    'idIpress' => $idIpress,
                ];
                $objContacto->registrarContacto($contacto);
            }
            $respuesta = ['rpta' => 'ok', 'data' => ''];
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
