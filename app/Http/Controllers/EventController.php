<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    //

    public function create(Topic $topic, Request $request){

       $json_body = json_encode($request->all());

        $topic = Topic::findOrFail($topic->id);
        $event = new Event();
        $event->body = $json_body;
        $event->topic_id = $topic->id;
        $event->save();

        if($event->save()){
            return response()->json(['message' => 'Event successfully published'], 200);
        }

        return response()->json(['message' => 'Event publishing Failed'], 300);
    }
}
