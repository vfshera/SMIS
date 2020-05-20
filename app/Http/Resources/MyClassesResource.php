<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyClassesResource extends JsonResource
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
            'teaches' => TimetableResource::collection($this->timetables),
            'created_at'=> date('D, dS F  Y', strtotime($this->created_at)),
        ];
    }
}
