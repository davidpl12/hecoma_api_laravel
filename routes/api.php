<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\SqlsrvService;

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



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
