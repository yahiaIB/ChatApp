<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable =['user_id' , 'other_id' , 'id'];
    protected $casts = ['id'=>'string',];
    public function messages()
    {
        return $this->hasMany(Message::class , 'conversation_id');
    }
}
