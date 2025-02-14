
<?php
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

//! auth
Route::post('/register', [AuthController::class, 'register']); //* ini untuk register
Route::post ('/login', [AuthController::class, 'login']); //*ini untuk login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); //* ini untuk logout
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']); //*ini untuk mengembil data user yg sedang login


//!category
Route::middleware('auth:sanctum')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

//!product
Route::middleware('auth:sanctum')->apiResource('products', ProductController::class);

//!order
Route::middleware('auth:sanctum')->apiResource('orders', OrderController::class);



//? bisa jg menggunkan cara yg lebih ringkas seperti kita buat route resouces seperti yg dulu pas final project


// Route::get('/user', [UserController::class, 'index']);
// Route::get ('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);
