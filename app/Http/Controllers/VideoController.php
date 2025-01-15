<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::all(); // All Video

        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Video Listed Succesfully',
            'video' => $video
        ], 200);
    }

    public function video(VideoRequest $request)
    {
        try {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $url = $request->url;
            $kategori = $request->kategori;

            Video::create([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'url' => $url,
                'kategori' => $kategori
            ]);

            return response()->json([
                'results' => "Video berhasil dibuat. '$judul' -- '$deskripsi' -- '$url' -- '$kategori' "
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
        // Video Details
        $video = Video::find($id);
        if (!$video) {
            return response()->json([
                'message' => 'Video tidak ditemukan.'
            ], 404);
        }

        // Return Json Respose
        return response()->json([
            'video' => $video
        ], 200);
    }

    public function update(VideoRequest $request, $id)
    {
        try {
            // Find Kuis
            $video = Video::find($id);
            if (!$video) {
                return response()->json([
                    'message' => 'Video tidak ditemukan.'
                ], 404);
            }

            $video->judul = $request->judul;
            $video->deskripsi = $request->deskripsi;
            $video->url = $request->url;
            $video->kategori = $request->kategori;

            // Update Kuis
            $video->save();

            // Return Json Response
            return response()->json([
                'message' => "Video sukses diupdate."
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
        $video = Video::find($id);
        if (!$video) {
            return response()->json([
                'message' => 'Video tidak ditemukan.'
            ], 404);
        }

        $video->delete();
        // Return Json Response
        return response()->json([
            'message' => "Video berhasil dihapus!"
        ], 200);
    }
}
