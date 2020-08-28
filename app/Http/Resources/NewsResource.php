<?php

namespace App\Http\Resources;

use App\News;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'info' => $this->info ,
            'title' => $this->title,
            'created_at' => date('H:i:s , dS F , Y', strtotime($this->created_at)),
        ];
    }
}
