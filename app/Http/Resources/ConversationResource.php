<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userOne = \App\User::findOrFail($this->user1);
        $usertwo = \App\User::findOrFail($this->user2);

        return [
            'id' => $this->id,
            'title' => (auth()->user()->id == $this->user1) ? $usertwo->name : $userOne->name,
            'messages' => MessagesResource::collection($this->messages),
        ];
    }
}
