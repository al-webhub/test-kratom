<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductTinyResource;
use Backpack\Store\app\Http\Resources\AttributeSmallResource;
use Backpack\Store\app\Http\Resources\CategoryTinyResource;

class ProductLargeResource extends JsonResource
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
        'name' => $this->name,
        'slug' => $this->slug,
        'price' => $this->price,
        'code' => $this->code,
        'images' => $this->images,
        'content' => $this->content,
        'rating' => $this->rating,
        'reviews_rating_detailes' => $this->reviewsRatingDetailes,
        'categories' => $this->categories && $this->categories->count()? CategoryTinyResource::collection($this->categories): null,
        'attrs' => $this->attrs && $this->attrs->count()? AttributeSmallResource::collection($this->attrs): null,
        'modifications' => $this->modifications && $this->modifications->count()? ProductTinyResource::collection($this->modifications): null,
        'seo' => $this->seoToArray
      ];
    }
}
