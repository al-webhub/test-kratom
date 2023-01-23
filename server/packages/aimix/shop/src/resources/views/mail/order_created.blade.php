@component('mail::message')
# Order info

@component('mail::table')
| Product       | Price         | Amount   |
| ------------- |:-------------:| --------:|
@foreach($order->info['products'] as $product)
@foreach($product as $modification)
| {{ $modification['product_name'] }} {{ $modification['name'] }}      | ${{ $modification['price'] }}      | {{ $modification['amount'] }}      |
@endforeach
@endforeach
@endcomponent

Total: ${{ $order->price }}

@if($order->transactions->where('type', 'bonuses_used')->first())
Bonuses used: ${{ - $order->transactions->where('type', 'bonuses_used')->first()->change }}

Total to pay: ${{ $order->price + $order->transactions->where('type', 'bonuses_used')->first()->change }}
@endif



@component('mail::button', ['url' => url('/')])
Back to site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
