<?php

namespace App\Http\Controllers;

use App\Models\SuratIzin;
use App\Http\Resources\SuratIzinResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class SuratIzinController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SuratIzin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratIzin = SuratIzin::all();

        return SuratIzinResource::collection($suratIzin);
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
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'permission' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'date_submission' => 'required|date',
        ]);

        $suratIzin = SuratIzin::create($request->all());

        return new SuratIzinResource($suratIzin);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function show(SuratIzin $suratIzin)
    {
        return new SuratIzinResource($suratIzin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratIzin $suratIzin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'permission' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'date_submission' => 'required|date',
        ]);

        $suratIzin->update($request->all());

        return new SuratIzinResource($suratIzin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratIzin $suratIzin)
    {
        $suratIzin->delete();

        return response()->json(null, 204);
    }
}