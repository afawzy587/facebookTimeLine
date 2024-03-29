<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\AllPostCollection;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
class PostController extends Controller
{
    use ImageUploadTrait;
    protected $postReprository;

    public function __construct(PostRepositoryInterface $postReprository)
    {
        $this->postReprository     =       $postReprository;
    }

    public function index()
    {

        $posts  =    $this->postReprository->getPosts();
        return Inertia::render('Posts',[
            'posts'      =>  new AllPostCollection($posts)
        ]);
        
    }

    public function store(PostCreateRequest $request)
    {
        $this->postReprository->add($request);
    }

    public function destroy($id)
    {
        $post = $this->postReprository->find($id);
        if (!empty($post->image)) {
            $currentImage = public_path() . $post->image;

            if (file_exists($currentImage)) {
                unlink($currentImage);
            }
        }
        $post->delete();
    }
}
