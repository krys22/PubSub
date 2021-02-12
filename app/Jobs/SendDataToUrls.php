<?php

namespace App\Jobs;

use App\Models\Subscriber;
use App\Models\Subscriptions;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendDataToUrls
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $subscription;

    public function __construct(Subscriptions $subcription)
    {
        //
        $this->subscription = $subcription;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $topic = Topic::findOrFail($this->subscription->topic_id);
        $subscriber = Subscriber::findOrFail($this->subscription->subscriber_id);

            //send the events to the url
            foreach($topic->events as $event){
                Http::post($subscriber->url, [
                    'data' => $event->body
                ]);


        }
    }
}
