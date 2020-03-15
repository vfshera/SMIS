<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StreamResource extends JsonResource
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
            'rep' => $this->rep,
            'created_at'=> date('D, dS F  Y', strtotime($this->created_at)),

        ];
    }
}
