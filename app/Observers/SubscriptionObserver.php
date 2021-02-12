<?php

namespace App\Observers;

use App\Jobs\SendDataToUrls;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Log;

class SubscriptionObserver
{
    /**
     * Handle the Subscriptions "creating" event.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return void
     */
    public function creating(Subscriptions $subscriptions)
    {
        //

        SendDataToUrls::dispatch($subscriptions);
    }


}
