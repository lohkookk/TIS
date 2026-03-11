<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParfumController extends Controller
{
    public function store(Request $request)
    {
        try {
            // 1. Validasi data parfum
            $validated = $request->validate([
                'kode_parfum' => 'required|string|unique:parfums,kode_parfum|max:10', // Contoh: PRF001
                'nama_parfum' => 'required|string|max:100',
                'brand'       => 'required|string|max:50',
                'harga'       => 'required|numeric|min:1000',
                'stok'        => 'required|integer|min:0',
                // Contoh input array untuk komposisi aroma (Top, Middle, Base Notes)
                'notes'       => 'required|array',
                'notes.*'     => 'required|string|max:30', 
            ]);

        } catch (\Illuminate\Validation\ValidationException $th) {
            // 2. Balikin error kalau inputan nggak sesuai format
            return response()->json([
                "message" => "Validasi gagal, cek kembali!",
                "errors"  => $th->validator->errors()
            ], 422);
        }

        // 3. Respon sukses (Dummy)
        // Nanti kalau udah dapet materi DML, di sini tempat naruh Parfum::create($validated)
        return response()->json([
            "message" => "Data parfum berhasil ditambahkan (Dummy)",
            "data"    => $validated
        ], 201);
    }
}
