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
        //get the sub_id with the url
        $urlId = Subscriber::getUrlId($request->get('url'));
        if(empty($urlId)){
            throw new Exception('This Url Doesnt exist');
        }

        $subscription = new Subscriptions();
        $subscription->topic_id = $topic->id;
        $subscription->subscriber_id = $urlId;
        if($subscription->save()){
            return response()->json(['message' => 'Subscription successful'], 200);
        }

        return response()->json(['message' => 'Subscription Failed'], 300);
    }
}
