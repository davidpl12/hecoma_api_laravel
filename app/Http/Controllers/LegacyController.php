<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class LegacyController extends Controller
{
    public function index()
    {
        // Incluir el helper (asegúrate de que la ruta sea correcta)
        require_once app_path('Helpers/LegacySqlsrv.php');

        try {
            // Intenta conectarte a la base de datos usando el helper
            $conn = legacy_sqlsrv_connect();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Ejemplo: Ejecutar una consulta para obtener la fecha actual
        $stmt = sqlsrv_query($conn, "SELECT GETDATE() AS current_date");
        if ($stmt === false) {
            $errors = sqlsrv_errors();
            return response()->json(['error' => json_encode($errors)], 500);
        }

        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return response()->json($data);
    }
}
