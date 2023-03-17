<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	$weight = $this->baseModification->attrs->find(1);
    
        return [
	      'id' => $this->id,
	      'name' => $this->name,
	      'slug' => $this->slug,
		  'link' => $this->link,
	      'price' => $this->baseModification->price,
		  'image' => url(str_replace('uploads', 'glide', $this->image) . '?h=168&w=168&fm=png'),
	      'description' => nl2br($this->description),
		  'excerpt' => substr(strip_tags($this->description), 0, 500).'...',
		  'modifications' => $this->notBaseModifications->get(),
		  'attrs' => $this->baseModification->getPluckedAttributesArray(),
	      'weight' => !$weight?:$weight->humanValue,
	      'stimulation' => $this->stimulation,
	      'relaxation' => $this->relaxation,
	      'euphoria' => $this->euphoria,
        ];
    }
}
