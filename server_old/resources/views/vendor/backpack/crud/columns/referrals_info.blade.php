@php
  $referrals = $entry->referrals;
  $transactions = $entry->transactions->where('order_id', '!=', null);
@endphp

<span>
  @if(count($referrals))
    <table>
      <tr>
        <th>Name</th>
        <th>Level</th>
        <th>Total bonus</th>
      </tr>
      @for($i = 0; $i < config('aimix.account.referral_levels'); $i++)
      @foreach($referrals as $referral)
      @php
        $referrals = $referral->referrals;
        $total = 0;
      @endphp
      @if($referral->isRegistred)
      <tr>
        <td><a href="{{ url('admin/usermeta/' . $referral->id . '/show') }}">{{ $referral->firstname }}</a></td>
        <td>{{ $i + 1 }}</td>
        <td>
        @foreach($transactions as $transaction)
          @if($transaction->order->usermeta_id == $referral->id)
            @php
              $total += $transaction->change;
            @endphp
          @endif
        @endforeach
        ${{ $total }}
        </td>
      </tr>
      @endif
      @endforeach
      @endfor
    </table>
  @endif
</span>