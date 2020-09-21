<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportantDatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $myTime = date('Y-m-d', strtotime($this->occur_date)) ." " . date('H:i:s', strtotime($this->occur_time));
        return [
            'id' => $this->id,
            'title' => $this->title,
            'occur_date' =>date('dS, F  Y', strtotime($this->occur_date)),
            'occur_time' =>date('H:i a', strtotime($this->occur_time)),
            'occurdate' => date('Y-m-d', strtotime($this->occur_date)),
            'occurtime' => date('H:i', strtotime($this->occur_time)),
            'passed' => date('U' , strtotime($myTime)) < time(),
        ];
    }
}
