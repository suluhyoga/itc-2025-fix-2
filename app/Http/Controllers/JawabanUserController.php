<?php

namespace App\Http\Controllers;

use App\Models\JawabanUser;
use App\Models\KunciJawaban;
use Illuminate\Http\Request;

class JawabanUserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kuis' => 'required|exists:kuis,id',
            'jawaban_user' => 'required|string',
        ]);

        // Ambil kunci jawaban berdasarkan ID kuis
        $kunci = KunciJawaban::where('id_kuis', $validated['id_kuis'])->first();

        if (!$kunci) {
            return response()->json(['message' => 'Kunci jawaban tidak ditemukan'], 404);
        }

        $isCorrect = $kunci->jawaban_kunci === $validated['jawaban_user'];

        // Simpan jawaban user ke database
        $jawabanUser = JawabanUser::create([
            'id_kuis' => $validated['id_kuis'],
            'jawaban_user' => $validated['jawaban_user'],
            'benar_salah' => $isCorrect,
        ]);

        // Respon
        return response()->json([
            'message' => $isCorrect ? 'Jawaban Benar' : 'Jawaban Salah',
            'data' => $jawabanUser,
        ]);
    }
}
