
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FormationController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::post('ajoutFormation', [FormationController::class, 'create']);
  Route::get('listFormation', [FormationController::class, 'index']);
  Route::post('updateFormation/{formation}', [FormationController::class, 'update']);
  Route::post('deleteFormation/{formation}', [FormationController::class, 'destroy']);

});

Route::post('postuler/{id_formation}', [CandidatureController::class, 'store']);
Route::post('/validercandidature/{candidature}', [CandidatureController::class, 'validercandidature']); 
Route::post('/refusercandidature/{candidature}', [CandidatureController::class, 'refusercandidature']);
Route::get('listCandidature', [CandidatureController::class, 'index']);
Route::get('listCandidatureValider', [CandidatureController::class, 'listCandidatureValider']);
Route::get('listCandidatureNonValider', [CandidatureController::class, 'listCandidatureNonValider']);






