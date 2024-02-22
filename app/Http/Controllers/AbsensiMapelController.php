<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbsensiMapelResource;
use App\Models\AbsensiMapel;
use Illuminate\Http\Request;

class AbsensiMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AbsensiMapelResource::collection(AbsensiMapel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'departement' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'mapel' => 'required|string',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $absensi_mapel = AbsensiMapel::create($validatedData);

        return response()->json(new AbsensiMapelResource($absensi_mapel), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensi_mapel = AbsensiMapel::findOrFail($id);
        return new AbsensiMapelResource($absensi_mapel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $absensi_mapel = AbsensiMapel::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'class' => 'sometimes|required|integer',
            'departement' => 'sometimes|required|string|max:255',
            'attendance' => 'sometimes|required|string|in:hadir,izin,sakit,alfa',
            'mapel' => 'sometimes|required|string',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $absensi_mapel->update($validatedData);

        return response()->json(new AbsensiMapelResource($absensi_mapel));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsensiMapel $absensi_mapel, $id)
    {
        $absensi_mapel = AbsensiMapel::findOrFail($id);

        if ($absensi_mapel) {
            $absensi_mapel->forceDelete();
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