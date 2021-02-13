<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Subscriptions;
use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SubscriptionsController extends Controller
{
    //

    public function create(Topic $topic, Request $request){

        //validate the request
        $validated = $request->validate([
            'url' => 'required|url'
        ]);

        $subscriber = Subscriber::getUrlId($request->get('url'))->first();

        if(empty($subscriber)){
         $subscriber =   Subscriber::create([
                'url' => $request->get('url')
            ]);
        }
        $subscription = Subscriptions::create([
            'topic_id' => $topic->id,
            'subscriber_id' => $subscriber->id
        ]);

        if($subscription){
            return response()->json(['message' => 'Subscription successful'], 200);
        }

        return response()->json(['message' => 'Subscription Failed'], 300);
    }
}
