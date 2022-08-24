<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use Intervention\Image\Facades\Image;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Community $community, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        $data = $request->safe()->except('post_image');

        if ($request->hasFile('post_image')) {
            $data['post_image'] = $request->post_image->store('posts');
            if ($post->post_image != null && \Storage::disk('public')->exists($post->post_image)) {
                $post->deleteImage();
            }
        }
        $post->update($data);

        return to_route('communities.posts.show', [$community, $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Community $community)
    {
        $data = $community->posts()->create($request->validated() + ['user_id' => auth()->id()]);

        if ($request->hasFile('post_image')) {

            $data->post_image = $request->post_image->store('posts');
            $data->save();
        }


        return to_route('communities.show', $community);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community, Post $post)
    {
        $post->load('comments.user');
        return view('posts.show', compact('community', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        return view('posts.edit', compact('community', 'post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403);
        }

        $post->delete();

        return to_route('communities.show', [$community]);
    }

    public function vote($post_id, $vote)
    {
        $post = Post::with('community')->findOrFail($post_id);

            if(!PostVote::where([['post_id', $post_id],['user_id', auth()->id()]])->count()
            && in_array($vote,[-1, 1]) && $post->user_id!=auth()->id()) {
            PostVote::create([
                'post_id' => $post_id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);

        $post->increment('votes', $vote);
        }

        return to_route('communities.show', $post->community);
    }
}
