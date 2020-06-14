<?php

namespace App\Http\Resources;

use App\Timetable;
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
            'classData' => new ClassroomResource($this->classroom),
            'noOfstudents' => count($this->classroom->students),
            'duty' => [
                 'id' => $this->duty->id,
                 'teacher' => new TeachersResource($this->duty->teacher),
                 'subject' => $this->duty->subject
                ],
            'term' => $this->term,
            'day' => $this->day,
            'time' => $this->time,
            'created_at' => date('dS F  Y', strtotime($this->created_at)),
        ];
    }

}
