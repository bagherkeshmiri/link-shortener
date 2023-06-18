<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinksResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'main_link' => $this->main_link,
            'shorten_link' => url('') . $this->shorten_link,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
