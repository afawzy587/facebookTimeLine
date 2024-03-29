<?php

namespace App\Repositories\Interfaces;

use App\Models\Comment;
use Error;
use Illuminate\Http\Request;
interface CommentRepositoryInterface  extends BaseRepositoryInterface 
{
    public function add(Request $request) : Comment | Error;
    public function bulckDelete(array $comments);
}
