<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\SuratTerlambat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\SuratTerlambatResource;

class SuratTerlambatController extends Controller
{
    public function index()
    {
        // Auth::authorize('suratterlambat.index');

        $suratTerlambat = SuratTerlambat::all();

        return SuratTerlambatResource::collection($suratTerlambat);
    }

    public function store(Request $request)
    {
        // Auth::authorize('suratterlambat.create');

        $request->validate([
            'name' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $suratTerlambat = SuratTerlambat::create([
            'name' => $request->name,
            'reason' => $request->reason,
            'date_time' => $request->date_time,
        ]);

        return new  SuratTerlambatResource($suratTerlambat);

        return redirect()->route('suratterlambat.index')->with('success', 'Surat Terlambat berhasil ditambahkan');
    }

    public function show($id)
    {
        $suratTerlambat = SuratTerlambat::findOrFail($id);
        return new SuratTerlambatResource($suratTerlambat);
    }

    public function update(Request $request, $id)
    {
        // Auth::authorize('suratterlambat.edit');

        $suratTerlambat = SuratTerlambat::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $suratTerlambat->update($request->all());

        return redirect()->route('suratterlambat.index')->with('success', 'Surat Terlambat berhasil diubah');
    }

    public function destroy(SuratTerlambat $suratTerlambat, $id)
    {
        // Auth::authorize('suratterlambat.delete');
        $suratTerlambat = SuratTerlambat::findOrFail($id);

        if ($suratTerlambat) {
            $suratTerlambat->forceDelete();
            return response()->json([
                'message' => 'Data Surat Terlambat berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Surat Terlambat tidak ditemukan'
            ], 404);
        }
    }

    public function generateSuratTerlambatReport(Request $request)
    {
        // Ambil data surat terlambat dari tabel 'surat_terlambat'
        $suratTerlambatList = SuratTerlambat::all();

        // Inisialisasi array untuk menyimpan data setiap surat terlambat
        $dataList = [];

        // Loop melalui setiap surat terlambat untuk mengambil informasi yang diperlukan
        foreach ($suratTerlambatList as $suratTerlambat) {
            $dataList[] = [
                'name' => $suratTerlambat->name,
                'reason' => $suratTerlambat->reason,
                'date_time' => $suratTerlambat->date_time,
                // Tambahkan data lain yang diperlukan
            ];
        }

        // Load view PDF dengan data yang telah ditentukan
        $pdf = new Dompdf();

        $html = view('laporan_surat_terlambat', compact('dataList'))->render();

        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Kembalikan file PDF sebagai respons
        return $pdf->stream('laporan_surat_terlambat.pdf');
    }
}
