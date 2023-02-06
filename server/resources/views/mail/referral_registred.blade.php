@component('mail::layout', ['header' => 'Congratulations'])
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; color: #333333; padding: 50px;">
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px; display: block; padding-bottom: 20px;">
        Hi{{ $user && $user->firstname? ', '. $user->firstname: '' }}</span>
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px;">
        New referral has joined your network!
        </span>
    </td>
</tr>
@endcomponent