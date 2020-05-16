<?php

namespace App\Http\Resources;

use App\Timetable;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyResource extends JsonResource
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
            'unit' => new TimetableResource($this->timetable),
        ];
    }
}
