@php
  $phone = '+420722133136';
  $email = 'info@kratomhelper.com';
  $address = 'Na Hřebenech II 1718/8, 14000 Praha 4-Nusle, Czech Republic';
@endphp
<tr style="padding: 50px 0 0 0;">
    <td style="padding: 0px 50px 15px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
        <b style="color: #333333; -webkit-text-size-adjust:none; text-transform: uppercase; font-size: 12px; line-height: 14px;">contact to us</b>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
        <span style="color: #333333; -webkit-text-size-adjust:none;">{{ $address }}</span>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
        <a href="mailto:{{ $email }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">{{ $email }}</a>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px; font: 14px Arial,sans-serif; line-height: 14px; Margin: 0;margin: 0;">
        <a href="tel:{{ $phone }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">{{ $phone }}</a>
    </td>
</tr>
<tr>
    <td style="padding: 30px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <b style="color: #333333; -webkit-text-size-adjust:none; text-transform: uppercase; font-size: 12px; line-height: 14px;">write to us</b>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <a href="{{ config('settings.tg') }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">Telegram</a>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <a href="{{ config('settings.whatsapp') }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">WhatsApp</a>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 0px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <a href="{{ config('settings.viber') }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">Viber</a>
    </td>
</tr>
<tr>
    <td style="padding: 30px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <b style="color: #333333; -webkit-text-size-adjust:none; text-transform: uppercase; font-size: 12px; line-height: 14px;">Follow us</b>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <a href="{{ config('settings.fb') }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">Facebook</a>
    </td>
</tr>
<tr>
    <td style="padding: 0px 50px 15px; font: 12px Arial,sans-serif; line-height: 21px; Margin: 0;margin: 0;">
        <a href="{{ config('settings.inst') }}" target="_blank" style="color: #333333; -webkit-text-size-adjust:none;">Instagram</a>
    </td>
</tr>
