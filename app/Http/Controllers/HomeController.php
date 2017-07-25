<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($other_id)
    {


        $exsist = Conversation::where('user_id' , auth()->user()->id)->where('other_id' , $other_id)->count();
        echo $other_id;
        if($exsist){
            $msgs = Conversation::with('messages')->where('user_id' , auth()->user()->id)->where('other_id' , $other_id)->first();
            echo $msgs ;
        }else{
            $conversation_id = str_random(5);

           $msgs =  Conversation::create([
                'id' => $conversation_id,
                'user_id' => auth()->user()->id,
                'other_id' => $other_id
            ]);

            Conversation::create([
                'id' => $conversation_id,
                'user_id' => $other_id,
                'other_id' => auth()->user()->id
            ]);
        }

        return view('home' , compact('msgs'));
    }
}
