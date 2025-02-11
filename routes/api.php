
<?php
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [UserController::class, 'index']);
Route::get ('/login', [AuthController::class, 'login']);
Route::post ('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);


// Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);
