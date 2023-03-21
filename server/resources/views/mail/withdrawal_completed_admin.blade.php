@component('mail::layout', ['header' => 'Заявка на вывод средств'])
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; color: #333333; padding: 50px;">
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px; display: block; padding-bottom: 20px;">
        Пользователь: {{ $transaction->owner->fullname ?? '' }}, Email: {{ $transaction->owner->email ?? '' }}</span>
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px;">
        {!! isset($transaction->description)? nl2br($transaction->description): '' !!}
        </span>
    </td>
</tr>
<tr>
  <td style="font: 16px Arial,sans-serif; line-height: 24px; Margin: 0;margin: 0; padding: 0px 50px 50px; text-align: center;">
    <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding: 40px; background-color:#F7F7F7">
      <b style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:10px; color: #ACDA53; font-size: 20px;">Информация о транзакции</b>
      <br>

      @if(isset($transaction->extras['method']) && !empty($transaction->extras['method']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Метод: {{ $transaction->extras['method'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['email']) && !empty($transaction->extras['email']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Email: {{ $transaction->extras['email'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['phone']) && !empty($transaction->extras['phone']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Телефон: {{ $transaction->extras['phone'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['country']) && !empty($transaction->extras['country']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Страна: {{ $transaction->extras['country'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['city']) && !empty($transaction->extras['city']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Город: {{ $transaction->extras['city'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['bank_card']) && !empty($transaction->extras['bank_card']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Банковская карта: {{ $transaction->extras['bank_card'] }}
        </span>
        <br>
      @endif

      @if(isset($transaction->extras['full_name']) && !empty($transaction->extras['full_name']))
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">
          Полное имя: {{ $transaction->extras['full_name'] }}
        </span>
        <br>
      @endif
      
      <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">Сумма вывода: ${{ - $transaction->value }}</span>
      <br>
      
      <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">Баланс(остаток): ${{ abs(round($transaction->balance, 2)) }}</span>
    </span>
  </td>
</tr>
@endcomponent

