<?php
require_once 'conexion.php';

class clsIpress
{
    function ListarIpress()
    {
        $sql = 'SELECT "idIpress","nombreIpress" FROM ipress';
        global $cnx;
        return $cnx->query($sql);
    }
    function validarLogin($DatosLogin)
    {
        $sql = 'SELECT "idIpress", "nombreIpress", "emailEstadistica", "emailIpress", clave FROM ipress WHERE "idIpress"=:idIpress';
        $parametros = [
            ':idIpress' => $DatosLogin,
        ];
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }
}
