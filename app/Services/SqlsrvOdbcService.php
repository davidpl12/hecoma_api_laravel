<?php

namespace App\Services;

class SqlsrvOdbcService
{
    protected $conn;

    public function __construct()
    {
        // DSN para conexión ODBC a SQL Server usando el driver ODBC Driver 17 for SQL Server
        $dsn = "Driver={ODBC Driver 17 for SQL Server};Server=84.232.22.204,1433;Database=Sage;";
        $username = "everybind";
        $password = "3v3Ry81nD#2024";

        $this->conn = odbc_connect($dsn, $username, $password);
        if (!$this->conn) {
            throw new \Exception("Error al conectar con la base de datos mediante ODBC: " . odbc_errormsg());
        }
    }

    /**
     * Ejecuta una consulta SQL y retorna el recurso de resultado
     */
    public function query($sql)
    {
        $result = odbc_exec($this->conn, $sql);
        if (!$result) {
            throw new \Exception("Error en la consulta: " . odbc_errormsg($this->conn));
        }
        return $result;
    }

    /**
     * Recupera los resultados de una consulta en un array asociativo
     */
    public function fetchAllAssoc($result)
    {
        $data = [];
        while ($row = odbc_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
