<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductTinyResource;
use Backpack\Store\app\Http\Resources\AttributeSmallResource;

class ProductSmallResource extends JsonResource
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
        'slug' => $this->slug,
        'price' => $this->price,
        'image' => $this->image,
        'rating' => $this->rating,
        'excerpt' => mb_substr(strip_tags($this->content), 0, 500).'...',
        'attrs' => $this->attrs && $this->attrs->count()? AttributeSmallResource::collection($this->attrs): null,
        'modifications' => $this->modifications && $this->modifications->count()? ProductTinyResource::collection($this->modifications): null
      ];
    }

    private function toHumanValue($x) {
      return floor($x / 20 * 2) / 2;
    }
}
