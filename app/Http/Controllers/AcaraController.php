<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function index()
    {
        $acara = Acara::all();

        return response()->json([
            'success' => true,
            'data' => $acara
        ]);
    }
    public function show($id)
    {
        $acara = Acara::find($id);

        if (!$acara) {
            return response()->json([
                'success' => false,
                'message' => 'Acara tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $acara
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_promotor' => 'required|exists:users,id',
            'judul' => 'required|max:150',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|max:50',
            'kuota_tiket' => 'required|integer|min:1',
            'url_poster' => 'required|string',
            'syarat_ketentuan' => 'required',
        ]);

        $acara = Acara::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil dibuat',
            'data' => $acara
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $acara = Acara::find($id);

        if (!$acara) {
            return response()->json([
                'success' => false,
                'message' => 'Acara tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'sometimes|max:150',
            'deskripsi' => 'sometimes',
            'harga' => 'sometimes|numeric|min:0',
            'kategori' => 'sometimes|max:50',
            'kuota_tiket' => 'sometimes|integer|min:1',
            'url_poster' => 'sometimes|string',
            'syarat_ketentuan' => 'sometimes',
            'status' => 'sometimes|in:pending,approved,rejected'
        ]);

        $acara->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil diperbarui',
            'data' => $acara
        ]);
    }

    public function destroy($id)
    {
        $acara = Acara::find($id);

        if (!$acara) {
            return response()->json([
                'success' => false,
                'message' => 'Acara tidak ditemukan'
            ], 404);
        }

        $acara->delete();

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil dihapus'
        ]);
    }
}
