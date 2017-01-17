<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Content_pin extends Model
{
    protected $table='content_pin';//테이블명
    protected $fillable = [//접근 가능 컬럼 목록
        'user_id', 'content_id',
    ];
}