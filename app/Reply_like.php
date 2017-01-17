<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply_like extends Model
{
    //
    protected $table = 'reply_likes';

    protected $fillable = ['user_id','reply_id','contents_id',];

    public function Reply(){
        return $this->belongsTo('App\Reply');
    }
}
