<?php
require_once 'conexion.php';

class clsIpress
{
    function ListarIpress()
    {
        $sql = 'SELECT "idIpress","nombreIpress","emailEstadistica", "emailIpress" FROM ipress ORDER BY "nombreIpress"';
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
    function filtrarIpress($filtro)
    {
        $sql = 'SELECT "idIpress", "nombreIpress", "emailEstadistica", "emailIpress" FROM ipress WHERE "nombreIpress" ILIKE :filtro';
        $parametros = [
            ':filtro' => '%' . $filtro . '%',
        ];
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }
}
