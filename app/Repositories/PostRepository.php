<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
  use ImageUploadTrait;
  public function __construct(Post $Post)
  {
      Parent::__construct($Post);
  }
  public function getPosts(): object
  {
     return $this->model->orderBy('created_at','DESC')->get();
  }

  public function add(Request $request) : Post | Error
  {
     try{
      DB::beginTransaction();
        $data = $request->except(['_token','image']);
        if($request->has('image')){
          if($request->hasFile('image')){
            $upload = $this->uploadImage($request->file('image'),'Posts');
            if($upload){
              $data['image']  = $upload;
            }
          }
        }
        $data['user_id']  = auth()->user()->id;

        $post =  $this->model->create($data);
        $post->save();
      DB::commit();
      return $post;
     }catch(\Exception $ex){
      DB::rollBack();
      return abort(400,$ex->getMessage());
     }
  }

  public function updateData( Request $request ,int|string $id ) :object
  {
    try{
      $data = $request->except(['_token','put','image']);

      if($request->has('image')){
        if($request->hasFile('image')){
          $upload = $this->uploadImage($request->file('image'),'Posts');
          if($upload){
            $data['image']  = $upload;
          }
        }
      }

      $post=  tap($this->model->findOrFail($id))->update($data);

      $post->save();
      return $post;
    }catch(\Exception $ex){
      DB::rollBack();
      return abort(400,$ex->getMessage());
    }
  }

  public function delete(int|string $id): bool
  {
    $post=$this->model->find( $id );
    if(!$post)
    {
      return abort(400,__('NoPostId'));
    }
    return  $post->delete();
  }





}
