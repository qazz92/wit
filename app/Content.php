<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $table = 'contents';

    protected $fillable = [
        'title', 'context', 'like', 'image', 'count', 'user_id', 'category_id',
    ];

    public function Reply() {
        return $this->hasMany('App\Reply');
    }
    public function Category(){
        return $this->hasOne('App\Category');
    }
}
