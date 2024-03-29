<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
  use ImageUploadTrait;
  public function __construct(Comment $comment)
  {
      Parent::__construct($comment);
  }
  public function add(Request $request) : Comment | Error
  {
     try{
      DB::beginTransaction();
        $data = $request->except(['_token']);
        $data['user_id']  = auth()->user()->id;
        $comment =  $this->model->create($data);
        $comment->save();
        DB::commit();
      return $comment;
     }catch(\Exception $ex){
      DB::rollBack();
      return abort(400,$ex->getMessage());
     }
  }

  public function delete(int|string $id): bool
  {
    $comment=$this->model->find( $id );
    if(!$comment)
    {
      return abort(400,__('NoCommentId'));
    }
    return  $comment->delete();
  }
  public function bulckDelete(array $comments)
  {
    return $this->model->WhereIn( 'id',$comments )->delete();
  }





}
