<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectsResource extends JsonResource
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
            'duty_id' => $this->id,
            'teacher' => $this->teacher->user->name,
            'name' => $this->subject->title,
            'abbr' => $this->subject->abbreviation,
        ];
    }
}
