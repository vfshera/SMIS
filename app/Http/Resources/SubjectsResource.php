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
        $tables = \App\Timetable::where('duty_id', $this->id)->get();

        return [
            'duty_id' => $this->id,
            'teacher' => $this->teacher->user->name,
            'teacher_id' => $this->teacher->id,
            'name' => $this->subject->title,
            'abbr' => $this->subject->abbreviation,
            'assigned' => ($tables->count() > 0)
        ];
    }
}
