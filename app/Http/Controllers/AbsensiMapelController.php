<?php

namespace App\Http\Controllers;

use App\Models\BukaAbsensi;
use App\Models\AbsensiMapel;
use Illuminate\Http\Request;
use App\Http\Resources\AbsensiMapelResource;

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

    // Ambil status buka absensi terkini
    $latest_buka_absensi = BukaAbsensi::latest()->first();

    // Periksa apakah absensi sedang dibuka
    if ($latest_buka_absensi && $latest_buka_absensi->status === 'Ditutup') {
        return response()->json(['message' => 'Maaf, absensi sedang ditutup.'], 403);
    }

    // Periksa apakah mapel yang diminta sesuai dengan mapel yang dibuka saat ini
    if ($latest_buka_absensi && $latest_buka_absensi->mapel !== $validatedData['mapel']) {
        return response()->json(['message' => 'Maaf, mapel yang diminta tidak sesuai dengan mapel yang dibuka saat ini.'], 403);
    }

    // Jika absensi sedang dibuka dan mapel sesuai, buat entri absensi baru
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
    // /**
    //  * Buka absensi.
    //  */
    // public function bukaAbsensi()
    // {
    //     // Pastikan hanya guru yang memiliki hak akses untuk membuka absensi
    //     if (!auth()->user()->is_guru) {
    //         return response()->json(['error' => 'Anda tidak memiliki izin untuk membuka absensi'], 403);
    //     }

    //     // Cek apakah absensi sudah dibuka sebelumnya
    //     if (AbsensiMapel::where('status', 'buka')->exists()) {
    //         return response()->json(['error' => 'Absensi sudah dibuka sebelumnya'], 400);
    //     }

    //     // Simpan status absensi buka ke dalam database
    //     AbsensiMapel::create(['status' => 'buka']);

    //     return response()->json(['message' => 'Absensi berhasil dibuka']);
    // }

    // /**
    //  * Tutup absensi.
    //  */
    // public function tutupAbsensi()
    // {
    //     // Pastikan hanya guru yang memiliki hak akses untuk menutup absensi
    //     if (!auth()->user()->is_guru) {
    //         return response()->json(['error' => 'Anda tidak memiliki izin untuk menutup absensi'], 403);
    //     }

    //     // Cek apakah absensi sedang dibuka
    //     $absensi = AbsensiMapel::where('status', 'buka')->first();
    //     if (!$absensi) {
    //         return response()->json(['error' => 'Absensi tidak dalam status terbuka'], 400);
    //     }

    //     // Simpan status absensi tutup ke dalam database
    //     $absensi->update(['status' => 'tutup']);

    //     return response()->json(['message' => 'Absensi berhasil ditutup']);
    // }
}