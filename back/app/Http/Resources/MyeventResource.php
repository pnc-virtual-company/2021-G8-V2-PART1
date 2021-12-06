<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyeventResource extends JsonResource
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
            "title"=>$this->title,
            "start_date"=>$this->start_date,
            "end_date"=>$this->end_date,
            "description"=>$this->description,
            "image"=>$this->image,
            "created_at"=>$this->created_at->format('D, j M Y h:i A'),
            "updated_at"=>$this->updated_at->format('D, j M Y h:i A'),
        ];
    }
}
