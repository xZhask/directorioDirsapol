<?php
require_once 'conexion.php';

class ClsIpress
{
    function ListarIpress()
    {
        $sql = 'SELECT "idIpress","nombreIpress" FROM ipress';
        global $cnx;
        return $cnx->query($sql);
    }
}
