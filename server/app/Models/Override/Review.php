<?php
namespace App\Models\Override;

use \Backpack\Reviews\app\Models\Review as BaseReview;
use \Backpack\Transactions\app\Traits\Transactionable;

class Review extends BaseReview
{
  use Transactionable;

  public function getMethodAttribute() {
    return $this->extras && isset($this->extras['method'])? $this->extras['method']: 'common';
  }
}
