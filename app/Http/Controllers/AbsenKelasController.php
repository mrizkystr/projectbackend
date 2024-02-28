<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AbsenKelasResource;
use App\Models\AbsenKelas;

class AbsenKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absenkelas = AbsenKelas::all();
        return AbsenKelasResource::collection($absenkelas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_murid_masuk' => 'required',
            'jumlah_murid_tidak_masuk' => 'required',
            'keterangan' => 'required',
        ]);

        $absenkelas = AbsenKelas::create([
            'jumlah_murid_masuk' => $request->jumlah_murid_masuk,
            'jumlah_murid_tidak_masuk' => $request->jumlah_murid_tidak_masuk,
            'keterangan' => $request->keterangan,
        ]);

        return new AbsenKelasResource($absenkelas);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absenkelas = AbsenKelas::findOrFail($id);
        return new AbsenKelasResource($absenkelas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_murid_masuk' => 'required',
            'jumlah_murid_tidak_masuk' => 'required',
            'keterangan' => 'required',
        ]);

        $absenkelas = AbsenKelas::findOrFail($id);
        $absenkelas->update([
            'jumlah_murid_masuk' => $request->jumlah_murid_masuk,
            'jumlah_murid_tidak_masuk' => $request->jumlah_murid_tidak_masuk,
            'keterangan' => $request->keterangan,
        ]);

        return new AbsenKelasResource($absenkelas);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsenKelas  $absenKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsenKelas $absenkelas)
    {
        $absenkelas->delete();
        return response()->json(null, 204);
    }
}
