<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataGuruResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'NIP' => $this->NIP,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'guru_mapel' => $this->guru_mapel,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
