<?php
$pass = '6l62I^2*vBAp';
$pass = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 7]);
echo $pass;
echo '</br>';
$passEnviado = '6l62I^2*vBAp';
echo password_verify($passEnviado, $pass);
