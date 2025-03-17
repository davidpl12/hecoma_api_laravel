<?php

namespace App\Services;

class SqlsrvService
{
    protected $conn;

    public function __construct()
    {
        $serverName = "84.232.22.204"; // Nombre del servidor SQL Server
        $connectionOptions = [
            "Database" => "Sage", // Nombre de la base de datos
            "Uid" => "everybind", // Usuario de la base de datos
            "PWD" => "3v3Ry81nD#2024" // Contraseña del usuario
        ];

        $this->conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($this->conn === false) {
            // En caso de error, lanza una excepción con el detalle
            throw new \Exception($this->formatErrors(sqlsrv_errors()));
        }
    }

    /**
     * Retorna el recurso de conexión
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
     * Ejecuta una consulta SQL y retorna el resultado
     */
    public function query($sql, $params = [])
    {
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            throw new \Exception($this->formatErrors(sqlsrv_errors()));
        }
        return $stmt;
    }

    /**
     * Formatea los errores de sqlsrv_errors en un string legible
     */
    private function formatErrors($errors)
    {
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = "SQLSTATE: {$error['SQLSTATE']} - Code: {$error['code']} - Message: {$error['message']}";
        }
        return implode(" | ", $errorMessages);
    }
}
