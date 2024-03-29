<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentBulckDeleteRequest;
use App\Http\Requests\CommentCreateRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $commentReprository;

    public function __construct(CommentRepositoryInterface $commentReprository)
    {
        $this->commentReprository  = $commentReprository;
    }

    public function store(CommentCreateRequest $request){
         $this->commentReprository->add($request);
    }

    public function destroy($id)
    {
         $this->commentReprository->delete($id);
    }

    public function bulck_delete(CommentBulckDeleteRequest $request)
    {
         $this->commentReprository->bulckDelete($request->comments);
    }

}
