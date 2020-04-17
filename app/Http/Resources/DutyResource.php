<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DutyResource extends JsonResource
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
            'teacher' => new TeachersResource($this->teacher_id),
            'subject' => new SubjectsResource($this->subject_id),
            'created_at' => date('dS F  Y', strtotime($this->created_at)),
        ];
    }
}
