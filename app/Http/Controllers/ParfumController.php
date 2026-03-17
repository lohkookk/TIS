<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parfum;

class ParfumController extends Controller
{
    // GET /api/parfums
    public function index()
    {
        $parfums = Parfum::all();

        return response()->json([
            "status"  => "success",
            "message" => "List data parfum berhasil diambil",
            "data"    => $parfums
        ]);
    }

    // POST /api/parfums
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_parfum' => 'required|string|unique:parfums,kode_parfum|max:10',
                'nama_parfum' => 'required|string|max:100',
                'brand'       => 'required|string|max:50',
                'harga'       => 'required|numeric|min:1000',
                'stok'        => 'required|integer|min:0',
                'notes'       => 'required|array',
                'notes.*'     => 'required|string|max:30',
            ]);

            $parfum = Parfum::create($validated);

            return response()->json([
                "message" => "Data parfum berhasil ditambahkan",
                "data"    => $parfum
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json([
                "message" => "Validasi gagal, cek kembali!",
                "errors"  => $th->validator->errors()
            ], 422);
        }
    }

    // PUT /api/parfums/{kode}
    public function update(Request $request, $kode)
    {
        $parfum = Parfum::where('kode_parfum', $kode)->first();

        if (!$parfum) {
            return response()->json([
                "message" => "Parfum dengan kode $kode tidak ditemukan"
            ], 404);
        }

        try {
            $validated = $request->validate([
                'nama_parfum' => 'required|string|max:100',
                'brand'       => 'required|string|max:50',
                'harga'       => 'required|numeric|min:1000',
                'stok'        => 'required|integer|min:0',
                'notes'       => 'required|array',
                'notes.*'     => 'required|string|max:30',
            ]);

            $parfum->update($validated);

            return response()->json([
                "message" => "Data parfum berhasil diupdate",
                "data"    => $parfum
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json([
                "message" => "Update gagal, validasi tidak terpenuhi",
                "errors"  => $th->validator->errors()
            ], 422);
        }
    }

    // DELETE /api/parfums/{kode}
    public function destroy($kode)
    {
        $parfum = Parfum::where('kode_parfum', $kode)->first();

        if (!$parfum) {
            return response()->json([
                "message" => "Parfum dengan kode $kode tidak ditemukan"
            ], 404);
        }

        $parfum->delete();

        return response()->json([
            "message" => "Parfum dengan kode $kode berhasil dihapus",
            "status"  => "success"
        ], 200);
    }
}