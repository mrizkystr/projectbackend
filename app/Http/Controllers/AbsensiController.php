<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Resources\AbsensiResource;
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

    public function generateAbsensi(Request $request)
    {
        // Ambil data absensi dari tabel 'absensi'
        $absensiList = Absensi::all();

        // Inisialisasi array untuk menyimpan data setiap absensi
        $dataList = [];

        // Loop melalui setiap absensi untuk mengambil informasi yang diperlukan
        foreach ($absensiList as $absensi) {
            $dataList[] = [
                'name' => $absensi->name,
                'class' => $absensi->class,
                'departement' => $absensi->departement,
                'attendance' => $absensi->attendance,
                'reason' => $absensi->reason,
                'date_time' => $absensi->date_time,
                // Tambahkan data lain yang diperlukan
            ];
        }

        // Load view PDF dengan data yang telah ditentukan
        $pdf = new Dompdf();

        $html = view('laporan_absensi_murid', compact('dataList'))->render();

        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Kembalikan file PDF sebagai respons
        return $pdf->stream('laporan_absensi.pdf');
    }
}
