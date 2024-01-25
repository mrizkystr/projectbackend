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
            'time' => 'nullable|date',
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
    public function show(AbsensiGuru $absensiGuru)
    {
        return response()->json(new AbsensiGuruResource($absensiGuru));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AbsensiGuru $absensiGuru)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'nullable|string',
            'time' => 'nullable|date',
        ]);

        $absensiGuru->update($validatedData);

        return response()->json(new AbsensiGuruResource($absensiGuru));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AbsensiGuru $absensiGuru)
    {
        $absensiGuru->delete();

        return response()->json(null, 204);
    }
}
