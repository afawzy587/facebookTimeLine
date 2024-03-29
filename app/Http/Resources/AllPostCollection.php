<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'body' => $item->body,
                'image' => $item->image,
                'created_at' => $item->created_at->format('d-m-Y H:i'),
                'comments' => $item->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'comment' => $comment->comment,
                        'user' => [
                            'id' => $comment->user?->id,
                            'name' => $comment->user?->name,
                            'image' => 'https://picsum.photos/id/140/300/320'
                        ],
                    ];
                }),
                'user' => [
                    'id' => $item->user->id,
                    'name' => $item->user->name,
                    'image' => 'https://picsum.photos/id/140/300/320'
                ],
            ];
        });
    }
}
