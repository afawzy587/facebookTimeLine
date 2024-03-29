<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Error;
use Illuminate\Http\Request;
interface PostRepositoryInterface extends  BaseRepositoryInterface 
{
    public function getPosts(): object;
    public function add(Request $request) : Post | Error;
    public function updateData( Request $request ,int|string $id ) :object;
}
