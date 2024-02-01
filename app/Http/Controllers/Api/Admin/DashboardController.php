<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AbsensiGuru;
use App\Models\SuratIzin;
use App\Models\SuratTerlambat;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the total number of users, posts, and comments
        $userCount = User::count();
        $suratIzinCount = SuratIzin::count();
        $absensiCount = Absensi::count();
        $absensiGuruCount = AbsensiGuru::count();
        $suratTerlambatCount = SuratTerlambat::count();

        // Return the data as a JSON response
        return response()->json([
            'user_count' => $userCount,
            'suratizin_count' => $suratIzinCount,
            'absensi_count' => $absensiCount,
            'absensiguru_count' => $absensiGuruCount,
            'suratterlambat_count' => $suratTerlambatCount,
        ]);
    }
}