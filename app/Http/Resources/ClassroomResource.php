<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
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
            'form' => $this->form->name,
            'stream' => $this->stream->name,
            'created_at'=> date('d M y', strtotime($this->created_at)),
        ];
    }
}
