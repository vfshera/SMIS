<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentInfoResource extends JsonResource
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
            'admNo' => $this->id,
            'user' => $this->user,
            'parent' => $this->parents_fname . " " . $this->parents_sname,
            'parentNo' => $this->parents_tel,
            'className' => $this->classroom->form->name ." ". $this->classroom->stream->name,
            'address' => $this->address,
            'town' => $this->town,
            'county' => $this->county,
            'joined' => date('D, dS F  Y', strtotime($this->created_at)),
            'studies' => StudyResource::collection($this->studies),
        ];
    }
}
