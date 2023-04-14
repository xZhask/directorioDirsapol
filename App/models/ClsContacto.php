<?php
require_once 'conexion.php';

class clsContacto
{
    function registrarContacto($datosContacto)
    {
        $sql = 'INSERT INTO contacto(nombre, grado, telefono, tipo, "idIpress")VALUES(:nombre,:grado,:telefono,:tipo,:idIpress)';
        $parametros = [
            ':nombre' => $datosContacto['nombre'],
            ':grado' => $datosContacto['grado'],
            ':telefono' => $datosContacto['telefono'],
            ':tipo' => $datosContacto['tipo'],
            ':idIpress' => $datosContacto['idIpress'],
        ];
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre->rowCount();
    }
    function actualizarEmails($datosContacto)
    {
        $sql = 'UPDATE ipress SET "emailEstadistica"=:emailEstadistica, "emailIpress"=:emailIpress WHERE "idIpress"=:idIpress';
        $parametros = [
            ':emailEstadistica' => $datosContacto['emailEstadistica'],
            ':emailIpress' => $datosContacto['emailIpress'],
            ':idIpress' => $datosContacto['idIpress'],
        ];
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre->rowCount();
    }
    function limpiarContactos($idIpress)
    {
        $sql = 'DELETE FROM contacto WHERE "idIpress"=:idIpress';
        $parametros = [
            ':idIpress' => $idIpress,
        ];
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre->rowCount();
    }
}

/*
DELETE FROM contacto
	WHERE "idIpress"=;
     */