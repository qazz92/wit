<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table = "reply";

    protected $fillable = [
        'context', 'type', 'likes', 'user_id', 'contents_id',
    ];

    public function Content() {
        return $this->belongsTo('App\Content');
    }

    public function Reply_like(){
        return $this->hasMany('App\Reply_like');
    }
}
