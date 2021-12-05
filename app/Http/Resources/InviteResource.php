<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InviteResource extends JsonResource
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
            'id'           => $this->id,
            'token'        => $this->token,
            'campaign'     => new CampaignResource($this->campaign),
            'responses'    => ResponseResource::collection($this->responses),
            'page'         => $this->page,
            'visitedPages' => $this->visited_pages,
        ];
    }
}
