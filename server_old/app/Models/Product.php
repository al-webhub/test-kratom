<?php

namespace App\Models;

use Aimix\Shop\app\Models\Product as PackageProduct;

use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends PackageProduct
{   
	public function getRouteKeyName()
	{
	    return 'slug';
	}

  public function toArray()
  {
    $salePercent = $this->baseModification->old_price ? number_format(($this->baseModification->old_price - $this->baseModification->price) * 100 / $this->baseModification->old_price, 0) : null;
    
    $weight = $this->baseModification->attrs->find(1);
/*
    if(!$this->baseModification->attrs->find(1))
    	dd($this->baseModification);
*/
    	
    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'category_id' => $this->category_id,
      'brand_id' => $this->brand_id,
      'price' => $this->baseModification->price,
      'old_price' => $this->baseModification->old_price,
      'sale_percent' => $salePercent,
      'is_active' => $this->is_active,
      'is_hit' => $this->is_hit,
      'rating' => $this->rating,
      'attrs' => $this->baseModification->getPluckedAttributesArray(),
      'extras' => $this->extras,
      'image' => url($this->image),
      'images' => $this->baseModification->images,
      'link' => $this->link,
      'amount' => isset($this->amount)? $this->amount : 1,
      'code' => $this->baseModification->code,
      'in_stock' => $this->baseModification->in_stock,
      'description' => $this->description,
      'excerpt' => substr(strip_tags($this->description), 0, 500).'...',
      'weight' => !$weight?:$weight->humanValue,
      'stimulation' => $this->stimulation,
      'relaxation' => $this->relaxation,
      'euphoria' => $this->euphoria,
      'modifications' => $this->notBaseModifications->get(),
      'category_slug' => $this->category->slug, // update
    ];
  }

  public function getLinkAttribute()
  {
    return url_locale($this->slug);
  }
  
/*
  public function getStimulationAttribute($value){
		return $value === null? 0 : $value;
	}
  public function getRelaxationAttribute($value){
		return $value === null? 0 : $value;
	}
  public function getEuphoriaAttribute($value){
		return $value === null? 0 : $value;
	}
*/
/*
  public function getStimulationAttribute(){
	  $value = $this->baseModification->attrs->find(2);
	  return $value? $value->humanValue: null;
  }
  
  public function getRelaxationAttribute(){
	  $value = $this->baseModification->attrs->find(3);
	  return $value? $value->humanValue: null;
  }
  
  public function getEuphoriaAttribute(){
	  $value = $this->baseModification->attrs->find(4);
	  return $value? $value->humanValue: null;
  }
*/
}