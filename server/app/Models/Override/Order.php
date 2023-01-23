<?php
namespace App\Models\Override;

use \Backpack\Store\app\Models\Order as BaseOrder;
use \Backpack\Transactions\app\Traits\Transactionable;

class Order extends BaseOrder
{
  use Transactionable;
}
