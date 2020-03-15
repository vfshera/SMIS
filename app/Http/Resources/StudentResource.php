<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
                'admission_no' => $this->id,
                'email' => $this->user->email,
                'parents_fname' => $this->parents_fname,
                'parents_sname' => $this->parents_sname,
                'parents_tel' => $this->parents_tel,
                'class_name' => $this->classroom->form->math_rep ." ". $this->classroom->stream->name,
                'address' => $this->address,
                'town' => $this->town,
                'county' => $this->county,
                'joined'=> date('dS F  Y', strtotime($this->created_at)),
            ];
    }
}
