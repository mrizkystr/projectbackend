<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuratTerlambatResource;
use App\Models\SuratTerlambat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SuratTerlambatController extends Controller
{
    public function index()
    {
        Gate::authorize('suratterlambat.index');

        $suratTerlambat = SuratTerlambat::all();

        return SuratTerlambatResource::collection($suratTerlambat);
    }

    public function create()
    {
        Gate::authorize('suratterlambat.create');

        return view('surat_terlambat.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('suratterlambat.create');

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

    public function edit(SuratTerlambat $suratTerlambat)
    {
        Gate::authorize('suratterlambat.edit');

        return view('surat_terlambat.edit', compact('suratTerlambat'));
    }

    public function update(Request $request, SuratTerlambat $suratTerlambat)
    {
        Gate::authorize('suratterlambat.edit');

        $request->validate([
            'name' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $suratTerlambat->update([
            'name' => $request->name,
            'reason' => $request->reason,
            'date_time' => $request->date_time,
        ]);

        return redirect()->route('suratterlambat.index')->with('success', 'Surat Terlambat berhasil diubah');
    }

    public function destroy(SuratTerlambat $suratTerlambat)
    {
        Gate::authorize('suratterlambat.delete');

        $suratTerlambat->delete();

        return redirect()->route('suratterlambat.index')->with('success', 'Surat Terlambat berhasil dihapus');
    }
}