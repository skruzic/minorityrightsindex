<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
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
            'question' => new QuestionResource($this->question),
            //'answer'   => $this->answer[0] == '[' ? json_decode($this->answer) : $this->answer,
            'answer'   => isJson($this->answer) ? json_decode($this->answer) : $this->answer,
        ];
    }
}
