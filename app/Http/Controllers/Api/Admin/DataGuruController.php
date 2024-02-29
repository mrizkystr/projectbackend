<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\DataGuru;
use App\Http\Resources\DataGuruResource;
use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGurus = DataGuru::all();
        return DataGuruResource::collection($dataGurus);
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
            'name' => 'required|string',
            'NIP' => 'required|string|unique:data_guru,NIP',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'alamat' => 'required|string',
            'guru_mapel' => 'required|string',
        ]);

        $dataGuru = DataGuru::create($request->all());
        return new DataGuruResource($dataGuru);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataGuru = DataGuru::findOrFail($id);
        return new DataGuruResource($dataGuru);
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
            'name' => 'required|string',
            'NIP' => 'required|string|unique:data_guru,NIP,'.$id,
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'alamat' => 'required|string',
            'guru_mapel' => 'required|string',
        ]);

        $dataGuru = DataGuru::findOrFail($id);
        $dataGuru->update($request->all());
        return new DataGuruResource($dataGuru);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataGuru = DataGuru::findOrFail($id);
        $dataGuru->delete();
        return response()->json(null, 204);
    }
}
