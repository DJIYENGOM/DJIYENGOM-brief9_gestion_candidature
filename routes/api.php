
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\FormationController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::post('ajoutFormation', [FormationController::class, 'create']);
Route::get('listFormation', [FormationController::class, 'index']);
Route::post('updateFormation/{formation}', [FormationController::class, 'update']);
Route::post('deleteFormation/{formation}', [FormationController::class, 'destroy']);


