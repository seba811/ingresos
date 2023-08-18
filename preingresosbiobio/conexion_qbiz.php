<?php
$contraseña = "qbizprize";

$usuario = "qbizprize";

$nombreBaseDeDatos = "BDPrize";

# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto

$rutaServidor = "10.10.3.181";

try {

    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);

    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {

    echo "Ocurrió un error con la base de datos: " . $e->getMessage();

}
?>