@component('mail::layout', ['header' => 'your order is confirmed'])
    <tr>
        <td style="font: 16px Arial,sans-serif; line-height: 24px; color: #333333; padding: 50px;">
            <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px; display: block;">Our manager will contact you soon</span>
        </td>
    </tr>
    <tr>
        <td style="padding: 0px 50px 15px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
            <b style="color: #333333; -webkit-text-size-adjust:none;font-size: 14px; line-height: 14px;">Recipient information:</b>
        </td>
    </tr>
    <!-- Customer Name-->
    <tr>
        <td style="padding: 0px 50px 10px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
            <span style="color: #333333; -webkit-text-size-adjust:none;">
            @if($user)
            	{{ $user['firstname'] }}
            @endif
            </span>
        </td>
    </tr>
    
    <!-- Customer Contacts-->
    <tr>
        <td style="padding: 0px 50px 10px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
            <span style="color: #333333; -webkit-text-size-adjust:none;">
            @if($user)
            	<p>{{ $user['communication'] . ': ' . $user['communication_number'] }}</p>
            	<p>{{  $user['email'] ?? '' }}</p>
            @endif
            </span>
        </td>
    </tr>
    <tr>
        <td style="padding: 0px 50px 10px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
            <span style="color: #333333; -webkit-text-size-adjust:none;">
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
            </span>
        </td>
    </tr>
    <tr>
        <td style="font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; padding: 15px 50px 50px; color: #FFFFFF;">
            <table border="0" cellpadding="0" cellspacing="0" style="overflow: auto; width: 100%; padding:30px; font: 14px Arial,sans-serif; line-height: 16px;" bgcolor = #333333>
                <tr>
                    <td style="padding: 0px 0px 30px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0; white-space: nowrap;">
                        <span style="color: #ffffff; -webkit-text-size-adjust:none; display: inline-block; width: 49%;">Your order #{{ $order->code }}</span>
                        <span style="color: #BDBDBD; -webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                    </td>
                </tr>
                
                @foreach($products as $product)
                    <tr>
                        <td style="Margin: 0;margin: 0;padding: 0px 0px 30px;">
                            <span style=" display:inline-block; vertical-align: middle;  text-align: center; padding-right: 20px;">
                                <img border="0" width="120" height="90" style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.25); display:inline-block; padding: 10px 25px;" src="{{ url($product['image']['src']) }}" alt="{{ $product['name'] }}">
                            </span>
                            <span style=" display:inline-block; vertical-align: middle; -webkit-text-size-adjust:none; padding-top: 5px;">
                                <span style=" display:block; padding-bottom: 20px;">
                                    <span style="color: #ffffff; -webkit-text-size-adjust:none; font-size: 14px; line-height: 16px; text-transform: uppercase;">{{ $product['name'] }}</span>
                                </span>
                                <span style=" display:block; padding-bottom: 20px;">
                                    <span style="color: #ffffff; -webkit-text-size-adjust:none; font-size: 14px; line-height: 14px;">{{ $product['name'] }} x <span>{{ $product['amount'] }}</span></span>
                                </span>
                                <span style="display:block;-webkit-text-size-adjust:none;">
                                    <span>USD <b>{{ $product['price'] }}</b></span>
                                </span>
                            </span>
                        </td>
                    </tr>
				        @endforeach
                <tr>
                    <td style="padding-top: 30px; font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; border-top: 1px solid #4F4F4F;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px 10px; font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; white-space: nowrap; text-transform: uppercase; color: #BDBDBD;">
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 49%;">subtotal</b>
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">usd {{ $order->price }}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px 10px; font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; white-space: nowrap; text-transform: uppercase; color: #BDBDBD;">
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 49%;">Bonuses used</b>
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">USD {{ $bonusesUsed }}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px 10px; font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; white-space: nowrap; text-transform: uppercase; color: #BDBDBD;">
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 49%;">shipping</b>
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">USD 0</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0px 0px; font: 14px Arial,sans-serif; line-height: 16px; Margin: 0;margin: 0; white-space: nowrap; text-transform: uppercase; color: #ACDA53;;">
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 49%;">total</b>
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">usd {{ $order->price - $bonusesUsed }}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 0px 50px 50px; font: 14px Arial,sans-serif; line-height: 24px; Margin: 0;margin: 0; text-align: center;">
            <b style="color: #333333; -webkit-text-size-adjust:none; text-transform: uppercase; font-size: 14px; line-height: 24px; text-transform: uppercase;">thank you for the order!</b>
        </td>
    </tr>
@endcomponent