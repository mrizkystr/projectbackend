<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbsensiGuruResource;
use App\Models\AbsensiGuru;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $absensi_gurus = AbsensiGuru::all();

        return AbsensiGuruResource::collection($absensi_gurus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'nullable|string',
            'time' => 'nullable|date_format:H:m:s',
        ]);

        $absensi_guru = AbsensiGuru::create($validatedData);

        return response()->json(new AbsensiGuruResource($absensi_guru), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $absensi_guru = AbsensiGuru::findOrFail($id);
        return new AbsensiGuruResource($absensi_guru);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $absensi_guru = AbsensiGuru::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'nullable|string',
            'time' => 'nullable|date_format:H:m:s',
        ]);

        $absensi_guru->update($validatedData);

        return response()->json(new AbsensiGuruResource($absensi_guru));
    }

    public function destroy(AbsensiGuru $absensi_guru, $id)
    {
        $absensi_guru = AbsensiGuru::findOrFail($id);

        if ($absensi_guru) {
            $absensi_guru->forceDelete();
            return response()->json([
                'message' => 'Data Absensi berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Absensi tidak ditemukan'
            ], 404);
        }
    }
}
