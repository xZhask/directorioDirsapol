<?php
/*
ENCRIPTAR 
$pass = '@Est2023';
$pass = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 7]);
echo $pass;
echo '</br>';
$passEnviado = '6l62I^2*vBAp';
echo password_verify($passEnviado, $pass);
*/
require_once 'App/models/ClsContacto.php';
require_once 'App/models/ClsIpress.php';

$objIpress = new clsIpress();
$objContacto = new clsContacto();

$jefeIpress = $objContacto->listarContacto('J', 6);

if ($jefeIpress->rowCount() > 0) {
    $jefeIpress = $jefeIpress->fetch(PDO::FETCH_OBJ);
    echo '<p>' . $jefeIpress->grado . '</p>';
    echo '<p class="p-negrita">Apellidos y nombres jefe de Ipress</p>';
    echo '<p>Telef.: 965201110</p>';
}
