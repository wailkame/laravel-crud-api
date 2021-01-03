<?php

namespace App\Http\Resources;


use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'post_text' => Str::limit($this->post_text, 50),
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
