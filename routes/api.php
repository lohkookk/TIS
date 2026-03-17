<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParfumController;

// ─── Parfum CRUD ───────────────────────────────────────
Route::get('/parfums', [ParfumController::class, 'index']);
Route::post('/parfums', [ParfumController::class, 'store']);      // fix: dari /parfum → /parfums (konsisten)
Route::put('/parfums/{kode}', [ParfumController::class, 'update']);
Route::patch('/parfums/{kode}', [ParfumController::class, 'update']);
Route::delete('/parfums/{kode}', [ParfumController::class, 'destroy']);

// ─── Auth ──────────────────────────────────────────────
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ─── Utility ───────────────────────────────────────────
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::get('/info', function () {
    return response()->json([
        "app"       => "Todo API",
        "version"   => "1.0",
        "developer" => "Teknologi Informasi"
    ]);
});

Route::get('/user/{name}', function ($name) {
    return response()->json([
        "message" => "Hello, " . $name . "!"
    ]);
});

Route::get('/calc/{a}/{b}/{op}', function ($a, $b, $op) {
    if ($op === 'div' && $b == 0) {
        return response()->json(["message" => "Tidak bisa dibagi nol!"], 422);
    }

    $result = match($op) {
        'add' => $a + $b,
        'sub' => $a - $b,
        'mul' => $a * $b,
        'div' => $a / $b,
        default => null
    };

    if ($result === null) {
        return response()->json(["message" => "Operasi tidak dikenal"], 422);
    }

    return response()->json([
        "operation" => $op,
        "a"         => (int)$a,
        "b"         => (int)$b,
        "result"    => $result
    ]);
});