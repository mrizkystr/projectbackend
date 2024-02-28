<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataSiswaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'NISN' => $this->NISN,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'kelas' => $this->kelas,
            'jurusan' => $this->jurusan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
