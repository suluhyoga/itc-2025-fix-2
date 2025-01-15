<?php

namespace App\Http\Controllers;

use App\Models\KunciJawaban;
use Illuminate\Http\Request;

class KunciJawabanController extends Controller
{
    /**
     * Menyimpan kunci jawaban yang diinput admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kuis' => 'required|exists:kuis,id',
            'jawaban_kunci' => 'required|string',
        ]);

        $kunciJawaban = KunciJawaban::create([
            'id_kuis' => $validated['id_kuis'],
            'jawaban_kunci' => $validated['jawaban_kunci'],
        ]);

        return response()->json([
            'message' => 'Kunci jawaban berhasil disimpan',
            'data' => $kunciJawaban,
        ]);
    }
}
