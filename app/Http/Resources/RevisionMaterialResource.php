<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevisionMaterialResource extends JsonResource
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
            'filename' => $this->filename,
            'file_type' => $this->file_type,
            'doc_type' => $this->doc_type,
            'owner' => $this->owner,
            'size' => $this->size,
            'title' => $this->title,
            'allow_delete' => ($this->owner == auth()->user()->id || auth()->user()->access == 0) ? true : false,
            'created_at' => date('dS F  Y', strtotime($this->created_at)),
        ];
    }
}
