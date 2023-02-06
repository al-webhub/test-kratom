@component('mail::layout', ['header' => 'New Order #'.$order->code.'<br>'.$order->created_at->format('d.m.Y H:i')])
	<tr>
		<td style="text-align: center; padding: 30px 30px 15px 30px;">
			<div><strong>Контакт</strong></div>
			@if($user)
				<div>{{ $user['firstname'].' '.$user['lastname'] }}</div>
        <div>
          {{ $user['communication'].': '.$user['communication_number'] }} 
          {{ $user['email'] ?? '' }}
        </div>
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
				@foreach($address as $item)
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
				@foreach($products as $product)
					<tr>
						<td style="padding:15px">
              @if(isset($product['image']) && isset($product['image']['src']))
                <img src="{{ url($product['image']['src']) }}" width="50px" />
              @endif
            </td>
						<td style="padding:15px">{{ $product['name'].',' ?? '' }} {{ $product['short_name'] ?? '' }}</td>
						<td style="padding:15px">x{{ $product['amount'] }}</td>
						<td style="padding:15px">{{ $product['price'] }}</td>
						<td style="padding:15px"><strong>{{ $product['amount'] * $product['price'] }}</strong></td>
					</tr>
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

@endcomponent
