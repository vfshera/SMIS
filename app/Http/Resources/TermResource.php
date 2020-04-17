<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
            'name' => $this->name,
            'beginning_on' => date('dS F  Y', strtotime($this->beginning_on)),
            'ending_on' => date('dS F  Y', strtotime($this->ending_on)),
            'begin_raw' => date('Y-m-d', strtotime($this->beginning_on)),
            'ending_raw' => date('Y-m-d', strtotime($this->ending_on)),
            'status' =>$this->status,
        ];
    }
}
