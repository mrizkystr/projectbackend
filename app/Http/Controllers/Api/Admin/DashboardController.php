<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Models\Absensi;
use App\Models\SuratIzin;
use App\Models\AbsensiGuru;
use Illuminate\Http\Request;
use App\Models\SuratTerlambat;
use App\Models\AbsensiMapel;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\AbsensiResource;
use App\Http\Resources\SuratIzinResource;
use App\Http\Resources\AbsensiGuruResource;
use App\Http\Resources\AbsensiMapelResource;
use App\Http\Resources\SuratTerlambatResource;

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
        $absensiMapelCount = AbsensiMapel::count();

        $absensi = AbsensiResource::collection(Absensi::get());
        $absensiGuru = AbsensiGuruResource::collection(AbsensiGuru::get());
        $suratIzin = SuratIzinResource::collection(SuratIzin::get());
        $suratTerlambat = SuratTerlambatResource::collection(SuratTerlambat::get());
        $absensiMapel = AbsensiMapelResource::collection(AbsensiMapel::get());
        $users = UserResource::collection(User::get());

        // Return the data as a JSON response
        return response()->json([
            'user_count' => $userCount,
            'suratizin_count' => $suratIzinCount,
            'absensi_count' => $absensiCount,
            'absensiguru_count' => $absensiGuruCount,
            'suratterlambat_count' => $suratTerlambatCount,
            'absensiMapel' => $absensiMapelCount,
            'absensi' =>  $absensi,
            'absensiguru' =>  $absensiGuru,
            'suratIzin' =>  $suratIzin,
            'suratTerlambat' =>  $suratTerlambat,
            'absensiMapel' => $absensiMapel,
            'users' => $users
        ]);
    }
}