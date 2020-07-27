<?php

namespace App\Http\Resources;

use App\Duty;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sub = json_decode(json_encode(new SubjectsResource(Duty::findOrFail($this->duty_id))));
        return [
            'subject' => $sub->abbr,
            'score' => $this->score."%",
        ];
    }
}
