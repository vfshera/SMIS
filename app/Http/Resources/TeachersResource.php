<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeachersResource extends JsonResource
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
                'name' => $this->user->name,
                'tsc' => $this->tsc_number,
                'email' => $this->user->email,
                'tel' => $this->tel,
                'address' => $this->address,
                'town' => $this->town,
                'county' => $this->county,
                'teaches' => SubjectsResource::collection( $this->duties),
                'joined' => date('dS F  Y', strtotime($this->created_at)),
        ];
    }
}
