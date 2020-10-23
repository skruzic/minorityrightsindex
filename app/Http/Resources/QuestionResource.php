<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OptionGroupResource;

class QuestionResource extends JsonResource
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
            'code'        => $this->code,
            'type'        => $this->type,
            'text'        => $this->text,
            'conditions'  => $this->conditions,
            'extras'      => $this->extras,
            'optiongroup' => new OptionGroupResource($this->optiongroup),
            'children'    => $this->children,
        ];
    }
}
