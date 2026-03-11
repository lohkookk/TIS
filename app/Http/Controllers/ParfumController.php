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

    // GET /api/parfums
    public function index()
    {
        // Data dummy koleksi parfum di toko kamu
        $parfums = [
            [
                "kode_parfum" => "PRF-001",
                "nama_parfum" => "Ocean Breeze",
                "brand"       => "Malang Fragrance",
                "harga"       => 150000,
                "stok"        => 25,
                "notes"       => [
                    "Sea Salt", "Bergamot", "Sage"
                ]
            ],
            [
                "kode_parfum" => "PRF-002",
                "nama_parfum" => "Midnight Oud",
                "brand"       => "Brawijaya Scents",
                "harga"       => 350000,
                "stok"        => 10,
                "notes"       => [
                    "Oud", "Saffron", "Leather", "Rose"
                ]
            ],
            [
                "kode_parfum" => "PRF-003",
                "nama_parfum" => "Vanilla Sky",
                "brand"       => "Ub Fragrance",
                "harga"       => 125000,
                "stok"        => 50,
                "notes"       => [
                    "Vanilla Bean", "Whipped Cream", "Coconut"
                ]
            ]
        ];

        // Mengembalikan respons dalam format JSON
        // Status code defaultnya 200 (OK)
        return response()->json([
            "status" => "success",
            "message" => "List data parfum berhasil diambil",
            "data" => $parfums
        ]);
    }

    // PUT /api/parfums/{kode}
public function update(Request $request, $kode)
{
    // 1. Simulasi mencari data berdasarkan kode_parfum
    // (Nanti kalau sudah pakai DB, pakainya Parfum::where('kode_parfum', $kode)->first())
    
    try {
        // 2. Validasi data baru yang dikirim user
        $validated = $request->validate([
            'nama_parfum' => 'required|string|max:100',
            'brand'       => 'required|string|max:50',
            'harga'       => 'required|numeric|min:1000',
            'stok'        => 'required|integer|min:0',
            'notes'       => 'required|array',
            'notes.*'     => 'required|string|max:30',
        ]);

        // 3. Respon Sukses (Dummy)
        return response()->json([
            "message" => "Data parfum dengan kode $kode berhasil diupdate (Dummy)",
            "data_sebelumnya" => [
                "kode_parfum" => $kode,
                "nama_parfum" => "Data Lama"
            ],
            "data_terbaru" => $validated
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $th) {
        return response()->json([
            "message" => "Update gagal, validasi tidak terpenuhi",
            "errors" => $th->validator->errors()
        ], 422);
    }
}
    // DELETE /api/parfums/{kode}
public function destroy($kode)
{
    // 1. Simulasi mencari data (logika aslinya nanti: Parfum::where('kode_parfum', $kode)->delete())
    
    // 2. Berikan respon sukses
    return response()->json([
        "message" => "Parfum dengan kode $kode berhasil dihapus dari sistem (Dummy)",
        "status"  => "success"
    ], 200);
}
}
