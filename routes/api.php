<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParfumController;

Route::post('/parfum', [ParfumController::class, 'store']);
Route::get('/parfums', [ParfumController::class, 'index']);
Route::put('/parfums/{kode}', [ParfumController::class, 'update']);
Route::patch('/parfums/{kode}', [ParfumController::class, 'update']);
Route::delete('/parfums/{kode}', [ParfumController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
return response()->json(['message' => 'pong']);
});


Route::get('/info', function () {
    return response()->json([
        "app" => "Todo API",
        "version" => "1.0",
        "developer" => "Teknologi Informasi"
    ]);
});

Route::get('/user/{name}', function ($name) {
    return response()->json([
        "message" => "Hello, " . $name . "!"
    ]);
});

Route::get('/calc/{a}/{b}/{op}', function ($a, $b, $op) {
    $result = 0;
    
    if ($op === 'add') {
        $result = $a + $b;
    } elseif ($op === 'sub') {
        $result = $a - $b;
    } elseif ($op === 'mul') {
        $result = $a * $b;
    } elseif ($op === 'div') {
        $result = $a / $b;
    }

    return response()->json([
        "operation" => $op,
        "a" => (int)$a,
        "b" => (int)$b,
        "result" => $result
    ]);
});