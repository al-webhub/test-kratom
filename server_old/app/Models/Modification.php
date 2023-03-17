<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Aimix\Shop\app\Models\Modification as PackageModification;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Modification extends PackageModification
{
  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'price' => $this->price,
      'old_price' => $this->old_price,
      'is_active' => $this->is_active,
      'is_default' => $this->is_default,
      'is_pricehidden' => $this->is_pricehidden,
      'in_stock' => $this->in_stock,
      'code' => $this->code,
      'attrs' => $this->getPluckedAttributesArray(),
      'extras' => $this->extras,
      'images' => $this->images,
      'amount' => isset($this->amount)? $this->amount : 1,
      'product_name' => $this->product->name,
      'product_image' => url($this->product->image),
      'product_link' => $this->product->link,
      'weight' => $this->weight
    ];
  }

  public function getWeightAttribute() {
	if($this->attrs && $this->attrs()->find(1))
    	return $this->attrs()->find(1)->pivotValue;
  }
}