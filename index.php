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
        <div class="cont-form">
            <h2><? echo $nombreIpress; ?>
                <span>UNIINSAN - ESTADÍSTICA DIRSAPOL</span>
            </h2>
            <form id="formContact" autocomplete="off">
                <h3>Ipress</h3>
                <div class="cont-input">
                    <label for="nombreJefeIpress">Nombre Jefe de Ipress</label>
                    <input type="text" name="nombreJefeIpress" id="nombreJefeIpress">
                </div>
                <div class="group-input">
                    <div class="cont-input">
                        <label for="gradoJefeIpress">Grado</label>
                        <input type="text" name="gradoJefeIpress" id="gradoJefeIpress">
                    </div>
                    <div class="cont-input">
                        <label for="telefonoJefeIpress">Teléfono</label>
                        <input type="tel" name="telefonoJefeIpress" id="telefonoJefeIpress" class="phone">
                    </div>
                </div>
                <div class="cont-input">
                    <label for="correoIpress">Correo institucional de la Ipress</label>
                    <input type="email" name="correoIpress" id="correoIpress">
                </div>
                <h3>Estadística</h3>
                <div class="cont-input">
                    <label for="nombreJefe">Nombre Jefe de estadística</label>
                    <input type="text" name="nombreJefe" id="nombreJefe">
                </div>
                <div class="group-input">
                    <div class="cont-input">
                        <label for="gradoJefe">Grado</label>
                        <input type="text" name="gradoJefe" id="gradoJefe">
                    </div>
                    <div class="cont-input">
                        <label for="telefonoJefe">Teléfono</label>
                        <input type="tel" name="telefonoJefe" id="telefonoJefe" class="phone">
                    </div>
                </div>
                <div class="cont-input">
                    <label for="correoArea">Correo institucional del área</label>
                    <input type="email" name="correoArea" id="correoArea">
                </div>

                <h3>Otros contactos estadística</h3>
                <div class="others_contacts">
                    <div class="card" id="card-1">
                        <div class="cont-input">
                            <label for="nombreOtro1">Nombre</label>
                            <input type="text" name="nombreOtro1" id="nombreOtro1" class="nameOthers">
                        </div>
                        <div class="group-input">
                            <div class="cont-input">
                                <label for="gradoOtro1">Grado</label>
                                <input type="text" name="gradoOtro1" id="gradoOtro1" class="gradoOthers">
                            </div>
                            <div class="cont-input">
                                <label for="telefonoOtro1">Teléfono</label>
                                <input type="tel" name="telefonoOtro1" id="telefonoOtro1" class="phone phoneOthers">
                            </div>
                        </div>
                        <a class="btnRemoveContact" onclick="removeContact(1)">Quitar</a>
                    </div>
                </div>
                <div class="cont-agregar">
                    <a id="btnAddNumber"><i class="fa-solid fa-plus"></i>Agregar otro número</a>
                </div>
                <button type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </form>
        </div>
    </div>
    <script language="javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script language="javascript" src="resources/js/jquery-ui-1.13.1/jquery-ui.min.js"></script>
    <script src="resources/js/main.js"></script>
</body>

</html>