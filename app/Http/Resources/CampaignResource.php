<?php

namespace App\Http\Resources;

use App\Enums\AccessType;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'access_type' => AccessType::getDescription($this->access_type),
            'questions'   => QuestionResource::collection($this->questions),
        ];
    }
}
