<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::all(); // All Feedback

        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Feedback Listed Succesfully',
            'feedback' => $feedback
        ], 200);
    }

    public function feedback(FeedbackRequest $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $pesan = $request->pesan;

            Feedback::create([
                'name' => $name,
                'email' => $email,
                'pesan' => $pesan
            ]);

            return response()->json([
                'results' => "Feedback berhasil dibuat. '$name' -- '$email' -- '$pesan' "
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
        // Feedback Details
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json([
                'message' => 'Feedback tidak ditemukan.'
            ], 404);
        }

        // Return Json Respose
        return response()->json([
            'feedback' => $feedback
        ], 200);
    }
}
