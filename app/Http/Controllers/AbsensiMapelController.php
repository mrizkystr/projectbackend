<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
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
        // Ambil entri BukaAbsensi yang sesuai dengan mapel yang dibuka dan status "Buka"
        $buka_absensi = BukaAbsensi::where('mapel', $request->mapel)
            ->where('status', 'Dibuka')
            ->first();

        if (!$buka_absensi) {
            return response()->json(['message' => 'Maaf, Absensi yang anda minta tidak dibuka.'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'departement' => 'required|string|max:255',
            'attendance' => 'required|string|in:hadir,izin,sakit,alfa',
            'mapel' => 'required|string',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Periksa apakah mapel yang diminta sesuai dengan mapel yang dibuka saat ini
        if ($buka_absensi->mapel !== $validatedData['mapel']) {
            return response()->json(['message' => 'Mapel yang diminta tidak sesuai dengan mapel yang dibuka saat ini.'], 403);
        }

        // Buat entri baru jika semua validasi terpenuhi
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

    public function generateAbsensiMapel(Request $request)
    {
        // Ambil data absensi dari tabel 'absensi_mapels'
        $absensiList = AbsensiMapel::all();

        // Inisialisasi array untuk menyimpan data setiap absensi
        $dataList = [];

        // Loop melalui setiap absensi untuk mengambil informasi yang diperlukan
        foreach ($absensiList as $absensi) {
            $dataList[] = [
                'name' => $absensi->name,
                'class' => $absensi->class,
                'departement' => $absensi->departement,
                'attendance' => $absensi->attendance,
                'mapel' => $absensi->mapel,
                'reason' => $absensi->reason,
                'date_time' => $absensi->date_time,
                // Tambahkan data lain yang diperlukan
            ];
        }

        // Load view PDF dengan data yang telah ditentukan
        $pdf = new Dompdf();

        $html = view('laporan_absensi_mapel', compact('dataList'))->render();

        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Kembalikan file PDF sebagai respons
        return $pdf->stream('laporan_absensi_mapel.pdf');
    }
}
