<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =['msg' , 'conversation_id'];



    public function conversation()
    {
        $this->belongsTo(Conversation::class , 'conversation_id');
    }

}
