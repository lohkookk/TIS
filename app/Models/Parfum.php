<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parfum extends Model
{
    protected $fillable = [
        'kode_parfum',
        'nama_parfum',
        'brand',
        'harga',
        'stok',
        'notes',
    ];

    protected $casts = [
        'notes' => 'array',   // Otomatis konversi JSON ↔ Array
        'harga' => 'decimal:2',
    ];
}