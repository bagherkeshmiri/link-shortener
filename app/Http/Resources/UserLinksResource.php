<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLinksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "main_link" => $this->main_link,
            "shorten_link" => url('').$this->shorten_link,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
