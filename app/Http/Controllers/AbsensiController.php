<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbsensiResource;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsensiController extends Controller
{
    public function index()
    {
        return AbsensiResource::collection(Absensi::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'departement' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_time',
        ]);

        $absensi = Absensi::create($validatedData);

        return new AbsensiResource($absensi);
    }

    public function show(Absensi $absensi)
    {
        return new AbsensiResource($absensi);
    }

    public function update(Request $request, Absensi $absensi)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'class' => 'sometimes|required|integer',
            'departement' => 'sometimes|required|string|max:255',
            'attendance' => 'sometimes|required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'sometimes|required|string|max:255',
            'date_time' => 'sometimes|required|date_time',
        ]);

        $absensi->update($validatedData);

        return new AbsensiResource($absensi);
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return response()->json(null, 204);
    }
}