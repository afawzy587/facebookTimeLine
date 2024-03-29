<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id','post_id','comment'];
    public function post(){
        $this->belongsTo(Post::class);
    }

    public function  user(){
        return $this->belongsTo(User::class);
    }

}