<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsenKelasResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jumlah_murid_masuk' => $this->jumlah_murid_masuk,
            'jumlah_murid_tidak_masuk' => $this->jumlah_murid_tidak_masuk,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
