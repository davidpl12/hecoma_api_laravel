<?php

use Illuminate\Support\Facades\Route;
use App\Services\SqlsrvService;

use App\Http\Controllers\LegacyController;

Route::get('/legacy-sqlsrv', [LegacyController::class, 'index']);

Route::get('/sqlsrv-test', function (SqlsrvService $sqlsrv) {
    try {
        // Ejecutamos una consulta de prueba (por ejemplo, obtener la fecha actual)
        $stmt = $sqlsrv->query("SELECT GETDATE() AS current_date");
        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }
        return response()->json($result);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

use App\Services\SqlsrvOdbcService;

Route::get('/odbc-test', function (SqlsrvOdbcService $db) {
    try {
        // Ejecuta una consulta de prueba, por ejemplo, obtener la fecha actual
        $result = $db->query("SELECT GETDATE() AS current_date");
        $data = $db->fetchAllAssoc($result);
        return response()->json($data);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
