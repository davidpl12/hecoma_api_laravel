<?php

if (!function_exists('legacy_sqlsrv_connect')) {
    function legacy_sqlsrv_connect()
    {
        $serverName = "84.232.22.204"; // Nombre del servidor SQL Server
        $connectionOptions = [
            "Database" => "Sage",      // Nombre de la base de datos
            "Uid" => "everybind",  // Usuario de la base de datos
            "PWD" => "3v3Ry81nD#2024" // Contraseña del usuario
        ];

        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn === false) {
            // En lugar de http_response_code, lanzamos una excepción
            $errors = sqlsrv_errors();
            throw new Exception(json_encode($errors));
        }
        return $conn;
    }
}
