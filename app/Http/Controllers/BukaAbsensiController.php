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
        ]);

        // Membuat data baru dalam tabel BukaAbsensi
        $bukaAbsensi = new BukaAbsensi();
        $bukaAbsensi->status = $request->status;
        $bukaAbsensi->save();

        return response()->json(['message' => 'Attendance status created successfully'], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Dibuka,Ditutup',
        ]);

        $bukaAbsensi = BukaAbsensi::find(1); // Sesuaikan dengan kebutuhan Anda

        if ($bukaAbsensi) {
            $bukaAbsensi->status = $request->status;
            $bukaAbsensi->save();
            
            return response()->json(['message' => 'Attendance status updated successfully']);
        } else {
            return response()->json(['error' => 'Attendance status not found'], 404);
        }
    }
}
