<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SoulsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'victim' => $this->victim,
            'reaper' => $this->reaper,
            'power' => $this->power,
            'soul_perished' => $this->soul_perished,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
