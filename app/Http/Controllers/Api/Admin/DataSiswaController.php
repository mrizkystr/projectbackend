<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Http\Resources\DataSiswaResource;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSiswa = DataSiswa::all();
        return DataSiswaResource::collection($dataSiswa);
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
            'name' => 'required',
            'NISN' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'alamat' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $dataSiswa = DataSiswa::create([
            'name' => $request->name,
            'NISN' => $request->NISN,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return new DataSiswaResource($dataSiswa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataSiswa = DataSiswa::findOrFail($id);
        return new DataSiswaResource($dataSiswa);
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
            'name' => 'required',
            'NISN' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'alamat' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $dataSiswa = DataSiswa::findOrFail($id);
        $dataSiswa->update([
            'name' => $request->name,
            'NISN' => $request->NISN,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return new DataSiswaResource($dataSiswa);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataSiswa  $dataSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSiswa $dataSiswa)
    {
        $dataSiswa->delete();
        return response()->json(null, 204);
    }
}
