<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuratIzinResource extends JsonResource
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
            'class' => $this->class,
            'departement' => $this->departement,
            'reason' => $this->reason,
            'date_submission' => $this->date_submission,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}