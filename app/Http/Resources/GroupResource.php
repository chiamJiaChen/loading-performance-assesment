<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $group = $this->whenLoaded('department');

        // return parent::toArray($request);

        return [
            // 
            'id' => $this->id ,
            'name' => $this->name 
        ];
    }
}
