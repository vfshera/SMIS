<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
            $tt = TimetableResource::collection($this->timetables);
            $tbls = [];
            $currterm = \App\Term::where('status' , 1)->pluck('id')->first();

            if($currterm){
                foreach ($tt as $tble){
                    if($tble->term->id === $currterm){
                            array_push($tbls,$tble);
                    }
                }
            }

            return [
                'id' => $this->id,
                'teaches' => $tbls,
                'created_at'=> date('D, dS F  Y', strtotime($this->created_at)),
            ];
    }
}
