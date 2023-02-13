<?php

namespace App\Observers;

use Illuminate\Support\Facades\Mail;

use \App\Models\Override\Profile;

use App\Mail\UserRegistered;
use App\Mail\ReferralRegistered;

class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function created(Profile $profile)
    {
      Mail::to($profile->email)->queue(new UserRegistered($profile));

      if($profile->referrer)
        Mail::to($profile->referrer->email)->queue(new ReferralRegistered($profile));
    }

    /**
     * Handle the Profile "updated" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function updated(Profile $profile)
    {
      //
    }

    /**
     * Handle the Profile "deleted" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function restored(Profile $profile)
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function forceDeleted(Profile $profile)
    {
        //
    }
}
