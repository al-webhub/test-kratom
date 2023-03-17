@component('mail::layout', ['header' => 'New feedback <br>' . $feedback->created_at->format('d.m.Y H:i')])
	
  <tr>
    <td style="text-align: center; padding: 30px 30px 15px 30px;">
      @if(isset($feedback['type']) && !empty($feedback['type']))
        <div><strong>Тип</strong></div>
        <div>{{ $feedback['type'] }}</div>
      @endif
      <br>
      <div><strong>Контакт</strong></div>
      @if(isset($feedback['name']) && !empty($feedback['name']))
        <div>Имя: {{ $feedback['name'] }}</div>
      @endif
      @if(isset($feedback['phone']) && !empty($feedback['phone']))
        <div>Телефон: {{ $feedback['phone'] }}</div>
      @endif
      @if(isset($feedback['email']) && !empty($feedback['email']))
        <div>Email: {{ $feedback['email'] }}</div>
      @endif
      <br>
      @if(isset($feedback['text']) && !empty($feedback['text']))
        <div><strong>Сообщение</strong></div>
        <div>{{ $feedback['text'] }}</div>
      @endif
    </td>
  </tr>
	
  @if(isset($product))
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
			</table>
		</td>
	</tr>
  @endif

  @component('mail::button', ['url' => url('/admin/feedback/'.$feedback->id.'/show') ])
    Подробнее
  @endcomponent
  
@endcomponent
