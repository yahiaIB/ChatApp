<?php

namespace App\Http\Controllers;

use App\Events\MsgBroadcast;
use App\Conversation;

use Illuminate\Http\Request;

class chatController extends Controller
{


    public function send()
    {
        $msg = request('msg');

        $conversation_id = request('conversation_id');

        broadcast(new MsgBroadcast($conversation_id , $msg))->toOthers();

        Conversation::where('id' , $conversation_id)->first()->messages()->create([
           'msg' => $msg
        ]);
    }
}
