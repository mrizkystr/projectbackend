<?php

namespace App\Http\Controllers;

use App\Models\BukaAbsensi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BukaAbsensiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Dibuka,Ditutup',
            'mapel' => 'required|string', // Tambahkan validasi untuk mapel
        ]);

        // Membuat data baru dalam tabel BukaAbsensi
        $bukaAbsensi = new BukaAbsensi();
        $bukaAbsensi->status = $request->status;
        $bukaAbsensi->mapel = $request->mapel; // Simpan data mapel
        $bukaAbsensi->save();

        return response()->json(['message' => 'Attendance status created successfully'], 201);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Dibuka,Ditutup',
            'mapel' => 'required|string', // Tambahkan validasi untuk mapel
        ]);

        $bukaAbsensi = BukaAbsensi::find($id); // Menemukan data BukaAbsensi berdasarkan ID yang diberikan

        if ($bukaAbsensi) {
            $bukaAbsensi->status = $request->status;
            $bukaAbsensi->mapel = $request->mapel; // Update data mapel
            $bukaAbsensi->save();

            return response()->json(['message' => 'Attendance status updated successfully']);
        } else {
            return response()->json(['error' => 'Attendance status not found'], 404);
        }
    }
}
