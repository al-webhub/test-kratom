@component('mail::layout', ['header' => 'your order is confirmed'])
        
@php
	$bonuses_used = $order->transactions->where('type', 'bonuses_used')->first();
	$bonuses_used = $bonuses_used? $bonuses_used->change: 0;
@endphp    
    
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
            @if($order->usermeta)
            	{{ $order->usermeta->firstname }}
            @endif
            </span>
        </td>
    </tr>
    
    <!-- Customer Contacts-->
    <tr>
        <td style="padding: 0px 50px 10px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
            <span style="color: #333333; -webkit-text-size-adjust:none;">
            @if($order->usermeta)
            	{{ $order->usermeta->extras['communication_number']? $order->usermeta->extras['communication'].': '.$order->usermeta->extras['communication_number']: ($order->usermeta->email? $order->usermeta->email: $order->usermeta->telephone) }}
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
				@foreach($order->info['address_details'] as $item)
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
                
                @foreach($order->info['products'] as $product)
                    @foreach($product as $modification)
                    <tr>
                        <td style="Margin: 0;margin: 0;padding: 0px 0px 30px;">
                            <span style=" display:inline-block; vertical-align: middle;  text-align: center; padding-right: 20px;">
                                <img border="0" width="52" height="54" style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.25); max-width:52px; max-height: 54px; display:inline-block; padding: 20px 35px 20px;" src="{{ url($modification['product_image']) }}" alt="{{ $modification['product_name'] }}">
                            </span>
                            <span style=" display:inline-block; vertical-align: middle; -webkit-text-size-adjust:none; padding-top: 5px;">
                                <span style=" display:block; padding-bottom: 20px;">
                                    <span style="color: #ffffff; -webkit-text-size-adjust:none; font-size: 14px; line-height: 16px; text-transform: uppercase;">{{ $modification['product_name'] }}</span>
                                </span>
                                <span style=" display:block; padding-bottom: 20px;">
                                    <span style="color: #ffffff; -webkit-text-size-adjust:none; font-size: 14px; line-height: 14px;">{{ $modification['name'] }} x <span>{{ $modification['amount'] }}</span></span>
                                </span>
                                <span style="display:block;-webkit-text-size-adjust:none;">
                                    <span>USD <b>{{ $modification['price'] }}</b></span>
                                </span>
                            </span>
                        </td>
                    </tr>
                    @endforeach
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
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">USD {{ $bonuses_used }}</b>
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
                        <b style="-webkit-text-size-adjust:none; display: inline-block; width: 50%; text-align: right;">usd {{ $order->price + $bonuses_used }}</b>
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