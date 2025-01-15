<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Http\Requests\KuisRequest;
use Illuminate\Support\Facades\Storage;
use PDO;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::all(); // All Kuis

        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Kuis Listed Succesfully',
            'kuis' => $kuis
        ], 200);
    }

    public function kuis(KuisRequest $request)
    {
        try {
            $judul = $request->judul;
            $kategori = $request->kategori;
            $pertanyaan = $request->pertanyaan;

            Kuis::create([
                'judul' => $judul,
                'kategori' => $kategori,
                'pertanyaan' => $pertanyaan
            ]);

            return response()->json([
                'results' => "Kuis berhasil dibuat. '$judul' -- '$kategori' -- '$pertanyaan' "
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function show($id)
    {
        // Kuis Details
        $kuis = Kuis::find($id);
        if (!$kuis) {
            return response()->json([
                'message' => 'Kuis tidak ditemukan.'
            ], 404);
        }

        // Return Json Respose
        return response()->json([
            'kuis' => $kuis
        ], 200);
    }

    public function update(KuisRequest $request, $id)
    {
        try {
            // Find Kuis
            $kuis = Kuis::find($id);
            if (!$kuis) {
                return response()->json([
                    'message' => 'Kuis tidak ditemukan.'
                ], 404);
            }

            $kuis->judul = $request->judul;
            $kuis->kategori = $request->kategori;
            $kuis->pertanyaan = $request->pertanyaan;

            // Update Kuis
            $kuis->save();

            // Return Json Response
            return response()->json([
                'message' => "Kuis sukses diupdate."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function destroy($id)
    {
        // Detail
        $kuis = Kuis::find($id);
        if (!$kuis) {
            return response()->json([
                'message' => 'Kuis tidak ditemukan.'
            ], 404);
        }

        $kuis->delete();
        // Return Json Response
        return response()->json([
            'message' => "Kuis berhasil dihapus!"
        ], 200);
    }
}
