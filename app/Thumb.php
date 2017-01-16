<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumb extends Model
{
    //
    protected $table = 'thumb';

    protected $fillable = [
        'thumbnail', 'user_id',
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
