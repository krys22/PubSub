<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\Subscriber;
use App\Models\Subscriptions;
use App\Models\Topic;
use App\Repositories\SubscriberRepository;
use App\Repositories\SubscriptionRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SubscriptionsController extends Controller
{
    //

    public function create(Topic $topic, CreateSubscriptionRequest $request,
                            SubscriberRepository $subscriberRepository,
                            SubscriptionRepository $subscriptionRepository){

        $subscriber = Subscriber::getUrlId($request->get('url'))->first();

        if(empty($subscriber)){
         $subscriber =   $subscriberRepository->create($request);
        }
        $subscription = $subscriptionRepository->create($topic, $subscriber);

        if($subscription){
            return response()->json(['message' => 'Subscription successful'], 200);
        }

        return response()->json(['message' => 'Subscription Failed'], 300);
    }
}
