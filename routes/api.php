<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function () {

    Route::prefix('field-control')->group(function() {
        Route::get('/qc-staff/download', [V1\FieldControl\FieldControlController::class, 'downloadQcStaff']);
        Route::post('/qc-staff/upload', [V1\FieldControl\FieldControlController::class, 'uploadQcStaff']);
    });

});
