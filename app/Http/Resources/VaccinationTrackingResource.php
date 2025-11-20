<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccinationTrackingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id ?? null,
            'user_id'            => $this->user_id ?? null,
            'name'               => $this->name ?? null,
            'type'               => $this->type ?? null,
            'primary_dose_date'  => $this->primary_dose_date ?? null,
            'booster_count'      => $this->vaccination_booster_count ?? 0,
            'status'             => $this->status ?? null,
            'hospital'           => $this->hospital ?? null,
            'created_at'         => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'         => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
