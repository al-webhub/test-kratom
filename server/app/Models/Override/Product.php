<?php
namespace App\Models\Override;

use Backpack\Store\app\Models\Product as BaseProduct;

class Product extends BaseProduct
{
  // getHumanStimulationAttribute() {
  //   $value_100_points = isset($this->extras['stimulation'])? $this->extras['stimulation']: 0;

  //   if($value_100_points === 0)
  //     return 0;

  //   $value_5_points = $value_100_points / 20;
  // }
  
  // getHumanRelaxationAttribute() {
  //   $value_100_points = isset($this->extras['relaxation'])? $this->extras['relaxation']: 0;

  //   if($value_100_points === 0)
  //     return 0;
  // }

  // getHumanEuphoriaAttribute() {
  //   $value_100_points = isset($this->extras['euphoria'])? $this->extras['euphoria']: 0;

  //   if($value_100_points === 0)
  //     return 0;
  // }
}
