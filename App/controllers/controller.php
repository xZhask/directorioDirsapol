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
            $updateEmails = $objContacto->actualizarEmails($datosEmails);
            /* LIMPIAR CONTACTOS REGISTRADOS */
            $limpiarContactos = $objContacto->limpiarContactos($idIpress);
            /* REGISTRO JEFE DE IPRESS */
            $jefeIpress = [
                'nombre' => $_POST['nombreJefeIpress'],
                'grado' => $_POST['gradoJefeIpress'],
                'telefono' => $_POST['telefonoJefeIpress'],
                'tipo' => 'J',
                'idIpress' => $idIpress,
            ];
            $registrarJefeIpress = $objContacto->registrarContacto($jefeIpress);

            /* REGISTRO JEFE DE ÁREA */
            $jefeArea = [
                'nombre' => $_POST['nombreJefe'],
                'grado' => $_POST['gradoJefe'],
                'telefono' => $_POST['telefonoJefe'],
                'tipo' => 'A',
                'idIpress' => $idIpress,
            ];
            $registrarJefeArea = $objContacto->registrarContacto($jefeArea);

            /* REGISTRO JEFE DE OTROS CONTACTOS */
            $otros = json_decode($_POST['otros']);
            $cont = count($otros);

            for ($i = 0; $i < $cont; $i++) {
                $nombre = $otros[$i]->{'nombre'};
                if ($nombre !== '') {
                    $contacto = [
                        'nombre' => $nombre,
                        'grado' => $otros[$i]->{'grado'},
                        'telefono' => $otros[$i]->{'phone'},
                        'tipo' => 'O',
                        'idIpress' => $idIpress,
                    ];
                    $objContacto->registrarContacto($contacto);
                }
            }


            if ($updateEmails > 0 && $limpiarContactos > 0 && $registrarJefeIpress > 0 && $registrarJefeArea > 0) {
                $rpta = 'Ok';
                $mensaje = 'Se registró correctamente';
            } else {
                $rpta = 'fail';
                $mensaje = 'Ocurrió un error, intentelo nuevamente';
            }
            $respuesta = ['rpta' => $rpta, 'data' => $mensaje];
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
        case 'LOGOUT':
            session_start();
            if (!empty($_SESSION['active']) == true) {
                $_SESSION['active'] = false;
                session_destroy();
                $response = ['rpta' => 'logout'];
                echo json_encode($response);
            }
            break;
        case 'LISTADO_DIRECTORIO':
            $filtro = $_POST['filtro'];
            $cont = 0;
            if ($filtro === '' || $filtro === 'NULL') $listado = $objIpress->ListarIpress();
            else $listado = $objIpress->filtrarIpress($filtro);

            $tabla = '';

            $listado = $listado->fetchAll(pdo::FETCH_OBJ);
            foreach ($listado as $k => $v) {
                $idIpress = $v->idIpress;
                $tabla .= '<tr>';
                $tabla .= '<td><p>' . $v->nombreIpress . '</p>';
                $tabla .= '<p class="p-email">Ipress: <span>' . $v->emailIpress . '</span></p>';
                $tabla .= '<p class="p-email">Estadíst.: <span>' . $v->emailEstadistica . '</span></p></td>';

                $tabla .= '<td>';
                $jefeIpress = $objContacto->listarContacto('J', $idIpress);

                if ($jefeIpress->rowCount() > 0) {
                    $jefeIpress = $jefeIpress->fetch(PDO::FETCH_OBJ);
                    $tabla .= '<p>' . $jefeIpress->grado . '</p>';
                    $tabla .= '<p class="p-negrita">' . $jefeIpress->nombre . '</p>';
                    $tabla .= '<p>Telef.: ' .  $jefeIpress->telefono . '</p>';
                }
                $tabla .= '</td>';
                $tabla .= '<td>';
                $jefeArea = $objContacto->listarContacto('A', $idIpress);

                if ($jefeArea->rowCount() > 0) {
                    $jefeArea = $jefeArea->fetch(PDO::FETCH_OBJ);
                    $tabla .= '<p>' . $jefeArea->grado . '</p>';
                    $tabla .= '<p class="p-negrita">' . $jefeArea->nombre . '</p>';
                    $tabla .= '<p>Telef.: ' . $jefeArea->telefono . '</p>';
                    $cont++;
                }
                $tabla .= '</td>';

                #For
                $tabla .= '<td>';
                $otrosContactos = $objContacto->listarContacto('O', $idIpress);
                if ($otrosContactos->rowCount() > 0) {
                    while ($fila = $otrosContactos->fetch(PDO::FETCH_OBJ)) {
                        # code...
                        $tabla .= '<div class="other-contact">
                                <p class="p-negrita"> ' . $fila->grado . ' ' . $fila->nombre . '</p>
                                <p>Telef.: ' . $fila->telefono . '</p>
                            </div>';
                    }
                }
                $tabla .= '</td>';
                $tabla .= '</tr>';
            }
            $response = ['data' => $tabla, 'total' => $cont];
            echo json_encode($response);
            break;
    }
}
