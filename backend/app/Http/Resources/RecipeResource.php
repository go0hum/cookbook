<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class RecipeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'preparation_time' => $this->preparation_time,
            'instructions' => $this->instructions,
            'user' => $this->userOne ? new UserResource($this->userOne) : null,
            'approved' => $this->approved ? new UserResource($this->approved): null,
            'ingredients' => $this->ingredients ? IngredientResource::collection($this->ingredients): null,
        ];
    }
}
