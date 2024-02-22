<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsensiMapelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'class' => $this->class,
            'departement' => $this->departement,
            'attendance' => $this->attendance_label,
            'mapel' => $this->mapel,
            'reason' => $this->reason,
            'date_time' => $this->date_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}