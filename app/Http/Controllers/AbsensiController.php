<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbsensiResource;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'date_time' => 'required|date_format:Y-m-d',
        ]);

        $absensi = Absensi::create($validatedData);

        return new AbsensiResource($absensi);
    }

    public function show($id)
    {
        $absensi = Absensi::findOrFail($id);
        return new AbsensiResource($absensi);
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'departement' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d',
        ]);

        $absensi->update($validatedData);

        return new AbsensiResource($absensi);
    }

    
    public function destroy(Absensi $absensi, $id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($absensi) {
            $absensi->forceDelete();
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
