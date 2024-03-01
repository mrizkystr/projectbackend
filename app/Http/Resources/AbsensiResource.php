<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsensiResource extends JsonResource
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
            'data_siswa_id' => $this->data_siswa_id,
            'class' => $this->class,
            'departement' => $this->departement,
            'attendance' => $this->attendance,
            'reason' => $this->reason,
            'date_time' => $this->date_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
