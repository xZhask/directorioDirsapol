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

require_once 'App/models/ClsIpress.php';
$objIpress = new clsIpress();

echo '<table>
<thead>
    <tr>
        <th>IPRESS</th>
        <th>JEFE IPRESS</th>
        <th>JEFE ÁREA</th>
        <th>OTROS CONTACTOS ESTADÍSTICA</th>
    </tr>
</thead>
</tbody>';
$listado = $objIpress->ListarIpress();
$listado = $listado->fetchAll(pdo::FETCH_OBJ);
foreach ($listado as $k => $v) {
    echo '<tr><td>' . $v->nombreIpress . '</td></tr>';
    # code...

}
echo '</tbody></table>';
//echo json_encode($listado);
