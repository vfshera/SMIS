<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $teacher = \App\Teacher::where('user_id' , $this->id)->first();

        return [
            'id' => $teacher->id,
            'name' => $this->name,
            'tsc' => $teacher->tsc_number,
            'email' => $this->email,
            'tel' => $teacher->tel,
            'address' => $teacher->address,
            'town' => $teacher->town,
            'county' => $teacher->county,
            'teaches' => SubjectsResource::collection( $teacher->duties),
            'joined' => date('dS F  Y', strtotime($teacher->created_at)),
        ];
    }
}
