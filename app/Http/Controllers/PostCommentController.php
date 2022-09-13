<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function store(Request $request, Post $post)
    {
        $post->load('community');

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment_text' => $request->comment_text
        ]);

        return to_route('communities.posts.show', [$post->community, $post]);
    }
}
