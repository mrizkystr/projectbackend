<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\AbsensiGuru;
use Illuminate\Http\Request;
use App\Http\Resources\AbsensiGuruResource;
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

public function generateAbsensiGuru(Request $request)
{
    // Ambil data absensi dari tabel 'absensi_guru'
    $absensiList = AbsensiGuru::all();

    // Inisialisasi array untuk menyimpan data setiap absensi
    $dataList = [];

    // Loop melalui setiap absensi untuk mengambil informasi yang diperlukan
    foreach ($absensiList as $absensi) {
        $dataList[] = [
            'name' => $absensi->name,
            'attendance' => $absensi->attendance,
            'reason' => $absensi->reason,
            'date_time' => $absensi->time,
            // Tambahkan data lain yang diperlukan
        ];
    }

    // Load view PDF dengan data yang telah ditentukan
    $pdf = new Dompdf();

    $html = view('laporan_absensi_guru', compact('dataList'))->render();

    $pdf->loadHtml($html);

    // Render PDF
    $pdf->render();

    // Kembalikan file PDF sebagai respons
    return $pdf->stream('laporan_absensi_guru.pdf');
}

}
