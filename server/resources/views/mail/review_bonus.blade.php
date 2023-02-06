@component('mail::layout', ['header' => 'Review bonus'])
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; color: #333333; padding: 50px;">
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px; display: owner; padding-bottom: 20px;">
        Hi{{ $transaction->owner && $transaction->owner->firstname? ', '.$transaction->owner->firstname: '' }}</span>
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px;">
        You received a bonus for posting a review on the site.
        </span>
    </td>
</tr>
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; Margin: 0;margin: 0; padding: 0px 50px 50px; text-align: center;">
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding: 40px; background-color:#F7F7F7">
            <b style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:10px; color: #ACDA53; font-size: 20px;">Transaction info</b><br>
            <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">Bonus amount: ${{ $transaction->value }}</span><br>
            <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">Bonus balance: ${{ $transaction->balance }}</span>
            <a href="https://kratomhelper.com/account/referral-network" target="_blank" style="-webkit-text-size-adjust:none; font-size: 14px; margin: 0px; color: #ffffff; width: 330px; height: 53px; border-radius: 30px; line-height: 53px; text-align: center; display: inline-block; background-color: #ACDA53; text-decoration: none; text-transform: uppercase;">view more</a>
        </span>
    </td>
</tr>
@endcomponent