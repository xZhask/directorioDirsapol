<?php
session_start();
if (!empty($_SESSION['active']) == true) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/47b4aaa3bf.js" crossorigin="anonymous"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Formulario</title>
</head>

<body class="body-login">
    <div class="wr-login">
        <div class="cont-logo-inicial">
            <img src="resources/img/_EscudoSanidad.png" alt="">
            <img src="resources/img/_EscudoPNP.png" alt="">
        </div>
        <div class="linea-v"></div>
        <form id="frm-login" class="frm-login" method="post">
            <h2>Login</h2>
            <input type="hidden" name="accion" value="LOGIN">
            <div class="cont-input-form">
                <select name="unidad" id="unidad">
                    <!--Ajax-->
                </select>
            </div>
            <div class="cont-input-form">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <button type="submit" class="btnform">Iniciar Sesión</button>
        </form>
    </div>
    <script src="resources/js/jquery-3.6.0.min.js"></script>
    <script src="resources/js/login.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>

</html>