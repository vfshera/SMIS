<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResource extends JsonResource
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
                'sender' => [
                                'id' =>  $this->sender,
                                'name' =>  \App\User::where('id' , $this->sender)->pluck('name')[0],
                             ],
                'receiver' => [
                                    'id' =>  $this->receiver,
                                    'name' =>  \App\User::where('id' , $this->receiver)->pluck('name')[0],
                                ],
                'message' => $this->message,
                'isYours' =>  (auth()->user()->id == $this->sender) ? true : false,
                'read' => $this->read,
                'sent_at' => [
                             'full_date' =>date('dS F  Y', strtotime($this->created_at)),
                             'time' =>date('H:i a', strtotime($this->created_at)),
                                'norm_date' => date('Y-m-d', strtotime($this->created_at)),
                            ],
            ];
    }
}
