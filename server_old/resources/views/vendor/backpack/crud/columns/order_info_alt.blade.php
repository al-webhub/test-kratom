@php
  $products = $entry->info['products'];
  $info = \Illuminate\Support\Arr::except($entry->info, ['products']);
  $usermeta = isset($entry['usermeta_id'])? \Aimix\Account\app\Models\Usermeta::find($entry['usermeta_id']) : null;
  $bonus_used = $entry->transactions->where('type', 'bonuses_used')->first();
  
  //dd($info);
@endphp
<span>
  @if($usermeta)
  <p>Имя: <a href="{{ url('admin/usermeta/' . $entry['usermeta_id'] . '/show' ) }}"><strong>{{ $usermeta->fullname }}</strong></a></p>
  @if($usermeta->email)
  <p>Email: <strong>{{ $usermeta->email }}</strong></p>
  @endif
  @if($usermeta->tel)
  <p>Телефон: <strong>{{ $usermeta->tel }}</strong></p>
  @endif
  
  @if(isset($usermeta->extras['communication']))
  <p>{{ $usermeta->extras['communication'] }}: <strong>{{ $usermeta->extras['communication_number'] }}</strong></p>
  @endif
   
  @endif
  
  @if(isset($info['address_details']))
  <p>Адрес: <strong>{{ implode(', ', $info['address_details']) }}</strong></p>
  @endif
  
  @if(isset($info['tel']))
  <p>Телефон: <strong>{{ $info['tel'] }}</strong></p>
  @endif
  @if(isset($info['email']))
  <p>Email: <strong>{{ $info['email'] }}</strong></p>
  @endif
  
  @if(isset($info['payment']))
  <p>Способ оплаты: <strong>{{ $info['payment'] }}</strong></p>
  @endif
  
  @if(isset($info['delivery']))
  <p>Способ доставки: <strong>{{ $info['delivery'] }}</strong></p>
  @endif
  
  @if(isset($info['point']))
  <p>Пункт выдачи: <strong>{{ $info['point'] }}</strong></p>
  @endif
  
  @if(isset($info['comment']))
  <p>Комментарий: <strong>{{ $info['comment'] }}</strong></p>
  @endif
  
  <hr>  
  <h5>Товары:</h5>
  @foreach($products as $product)
  @foreach($product as $modification)
  <p>
    <span><u>{{ $modification['product_name'] }} {{ $modification['name'] }}</u></span>,
    <span>{{ $modification['price'] }} x {{ $modification['amount'] }}шт. </span>
    <span> = <strong>${{ $modification['price'] * $modification['amount'] }}</strong></span>
  </p>
  
  <hr>
  @endforeach
  @endforeach
  <h5>Сумма заказа: <strong>${{ $entry->price }}</strong></h5>
  @if($bonus_used)
  <br>
  <h5>Бонусов использовано: <strong>${{ - $bonus_used->change }}</strong></h5>
  <br>
  <h4>Сумма к оплате: <strong>${{ $entry->price + $bonus_used->change }}</strong></h4>
  @endif
</span>