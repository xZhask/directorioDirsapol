<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: login.php');
}
if ($_SESSION['idIpress'] !== 82) {
    header('location: index.php');
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
        <div class="cont-listado">
            <div class="header-table">
                <input type="text" name="nombreIpress" id="nombreIpress" placeholder="Buscar...">
                <p class="contador" id="contador">0/82</p>
                <i class="fa-solid fa-power-off btn-salir"></i>
            </div>
            <div class="body-table">
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
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script language="javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script language="javascript" src="resources/js/jquery-ui-1.13.1/jquery-ui.min.js"></script>
    <script src="resources/js/directorio.js"></script>
    <script>
        cargarDirectorio()
    </script>
</body>

</html>