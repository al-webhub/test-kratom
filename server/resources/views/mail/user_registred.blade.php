@component('mail::layout', ['header' => 'Welcome to kratomhelper'])
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; color: #333333; padding: 50px;">
        <span style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px;">Thanks for creating an account on KRATOMHELPER. Your username is <b>{{ $user->firstname }}</b>. You can access your account area to view orders, change your password, and more at: <a href="https://kratomhelper.com/account/order-history" target="_blank" style="-webkit-text-size-adjust:none; font-size: 16px; margin: 0px; color: #ACDA53; text-decoration: none;">https://kratomhelper.com/account/order-history</a></span>
    </td>
</tr>
<tr>
    <td style="font: 16px Arial,sans-serif; line-height: 24px; Margin: 0;margin: 0; padding: 0px 50px 50px; text-align: center;">
        <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding: 40px; background-color:#F7F7F7">
            <b style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:10px; color: #ACDA53; font-size: 20px;">Info</b>
            <span style="color: #333333; -webkit-text-size-adjust:none; display: block; padding-bottom:20px;">To start with, we would like to inform you about the thing that differs us from other sellers. All of them will assure you that their kratom is of the highest quality. But is it not possible for everyone to have it. We are really aware of this fact as far as we travelled to Indonesia and visited different Indonesian islands ourselves. </span>
            <span style="color: #333333; -webkit-text-size-adjust:none; display: inline-block; padding-bottom:20px;">This way, we know exactly what “the kratom at first hand” is, we know the way it is grown, we know the people who handle it, we know its value among the local people, and we know which type has the highest value. </span>
            <a href="https://kratomhelper.com/shop" target="_blank" style="-webkit-text-size-adjust:none; font-size: 14px; margin: 0px; color: #ffffff; width: 330px; height: 53px; border-radius: 30px; line-height: 53px; text-align: center; display: inline-block; background-color: #ACDA53; text-decoration: none; text-transform: uppercase;">choose kratom</a>
        </span>
    </td>
</tr>
@endcomponent
