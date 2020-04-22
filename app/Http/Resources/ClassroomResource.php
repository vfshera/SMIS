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
            'name' => $this->form->name . " " . $this->stream->name,
            'form' => new FormResource($this->form),
            'stream' => new StreamResource($this->stream),
            'created_at'=> date('D, dS F  Y', strtotime($this->created_at)),
        ];
    }
}
