<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableResource extends JsonResource
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
            'classData' => new ClassroomResource($this->class_id),
            'duty' => new DutyResource($this->duty_id),
            'term' => new TermResource($this->term_id),
            'day' => $this->day,
            'time' => $this->time,
            'created_at' => date('dS F  Y', strtotime($this->created_at)),
        ];
    }
}
