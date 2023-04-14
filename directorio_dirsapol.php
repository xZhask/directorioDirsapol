<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: login.php');
}
$nombreIpress = $_SESSION['nombreIpress'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/47b4aaa3bf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/js/jquery-ui-1.13.1/jquery-ui.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Directorio</title>
</head>

<body>
    <div class="wrapper">
        <div class="cont-table">
            <div class="header-table">
                <input type="text" name="nombreIpress" id="nombreIpress" placeholder="Buscar...">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>IPRESS</th>
                        <th>JEFE IPRESS</th>
                        <th>JEFE ÁREA</th>
                        <th>OTROS CONTACTOS ESTADÍSTICA</th>
                    </tr>
                </thead>
                <tbody id="tb-directorio">
                    <tr>
                        <td>
                            <p> NOMBRE DE IPRESS</p>
                            <p class="p-email">Ipress: <span>unidad.ipress@policia.gob.pe</span></p>
                            <p class="p-email">Estadíst.: <span>unidad.estadistica@policia.gob.pe</span></p>
                        </td>
                        <td>
                            <p>Grado</p>
                            <p class="p-negrita">Apellidos y nombres jefe de Ipress</p>
                            <p>Telef.: 965201110</p>
                        </td>
                        <td>
                            <p>Grado</p>
                            <p class="p-negrita">Apellidos y nombres jefe de Est</p>
                            <p>Telef.: 965201110</p>
                        </td>
                        <td>
                            <div class="other-contact">
                                <p class="p-negrita"> Grado Apellidos y Nombres de Otros</p>
                                <p>Telef.: 965201110</p>
                            </div>
                            <div class="other-contact">
                                <p class="p-negrita"> Grado Apellidos y Nombres de Otros</p>
                                <p>Telef.: 965201110</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> NOMBRE DE IPRESS</p>
                            <p class="p-email">Ipress: <span>unidad.ipress@policia.gob.pe</span></p>
                            <p class="p-email">Estadíst.: <span>unidad.estadistica@policia.gob.pe</span></p>
                        </td>
                        <td>
                            <p>Grado</p>
                            <p class="p-negrita">Apellidos y nombres jefe de Ipress</p>
                            <p>Telef.: 965201110</p>
                        </td>
                        <td>
                            <p>Grado</p>
                            <p class="p-negrita">Apellidos y nombres jefe de Est</p>
                            <p>Telef.: 965201110</p>
                        </td>
                        <td>
                            <div class="other-contact">
                                <p class="p-negrita"> Grado Apellidos y Nombres de Otros</p>
                                <p>Telef.: 965201110</p>
                            </div>
                            <div class="other-contact">
                                <p class="p-negrita"> Grado Apellidos y Nombres de Otros</p>
                                <p>Telef.: 965201110</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script language="javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script language="javascript" src="resources/js/jquery-ui-1.13.1/jquery-ui.min.js"></script>
    <script src="resources/js/main.js"></script>
    <script>
        cargarDirectorio()
    </script>
</body>

</html>