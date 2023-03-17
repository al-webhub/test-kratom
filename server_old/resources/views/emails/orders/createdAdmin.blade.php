@component('mail::layout', ['header' => 'New Order #'.$order->code.'<br>'.$order->created_at->format('d.m.Y H:i')])


	<tr>
		<td style="text-align: center; padding: 30px 30px 15px 30px;">
			<div><strong>Контакт</strong></div>
			@if($order->usermeta)
				<div>{{ $order->usermeta->firstname.' '.$order->usermeta->lastname }}</div>
				<div>{{ $order->usermeta && $order->usermeta->extras?  (isset($order->usermeta->extras['communication_number']) && isset($order->usermeta->extras['communication'])? $order->usermeta->extras['communication'].': '.$order->usermeta->extras['communication_number']: $order->usermeta->telephone.' '.$order->usermeta->email): '' }}</div>
			@else
				<div>{{ $order->info['firstname'].' '.$order->info['lastname'] }}</div>
				<div>{{ $order->info['extras']['communication'].': '.$order->info['extras']['communication_number'] }}</div>
			@endif
		</td>
	</tr>
	
	<tr>
		<td style="text-align: center; padding: 15px 30px 30px 30px;">
			<div><strong>Адрес доставки</strong></div>
			<div>
				@php
				$key = 0;
				@endphp
				@foreach($order->info['address_details'] as $item)
				@if($item)
				{{ $key == '0'? $item : ', ' . $item }}
				@endif
				@php
				$key++;
				@endphp
				@endforeach
			</div>
		</td>
	</tr>

	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" style="overflow: auto; width: 100%; padding:30px; font: 14px Arial,sans-serif; line-height: 16px;">
				<tr>
					<th>Фото</th>
					<th>Название</th>
					<th>Кол.</th>
					<th>Цена</th>
					<th>Сум.<sup>USD</sup></th>
				</tr>
				@foreach($order->info['products'] as $product)
					@foreach($product as $modification)
					<tr>
						<td style="padding:15px"><img src="{{ $modification['product_image'] }}" width="50px" /></td>
						<td style="padding:15px">{{ $modification['product_name'] }}, {{ $modification['name'] }}</td>
						<td style="padding:15px">x{{ $modification['amount'] }}</td>
						<td style="padding:15px">{{ $modification['price'] }}</td>
						<td style="padding:15px"><strong>{{ $modification['amount'] * $modification['price'] }}</strong></td>
					</tr>
					@endforeach
				@endforeach
				<tr>
					<th style="padding:15px; border-top:1px solid #ddd; text-align: right;" colspan="3">Итого</th>
					<th style="padding:15px; border-top:1px solid #ddd" colspan="2">{{ $order->price }}USD</th>
				</tr>
			</table>
		</td>
	</tr>

@component('mail::button', ['url' => url('/admin/order/'.$order->id.'/show') ])
Подробнее
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
