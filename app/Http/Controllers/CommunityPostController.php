<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use App\Notifications\PostReportNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Storage;

class CommunityPostController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Community $community
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)) {
            abort(403);
        }

        $data = $request->safe()->except('post_image');

        if ($request->hasFile('post_image')) {
            $data['post_image'] = $request->post_image->store('posts');
            if ($post->post_image != null && Storage::disk('public')->exists($post->post_image)) {
                $post->deleteImage();
            }
        }
        $post->update($data);

        return to_route('communities.posts.show', $post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @param Community $community
     * @return RedirectResponse
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
     * @return Application|Factory|View
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show($post)
    {
        $post =Post::with('comments.user', 'community')->findOrFail($post);
        return view('posts.show', compact( 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)) {
            abort(403);
        }

        return view('posts.edit', compact('community', 'post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Community $community, Post $post)
    {
        if (Gate::denies('delete-post', $post)) {
            abort(403);
        }
        $post->delete();

        return to_route('communities.show', $community);
    }

    /**
     * @param $post_id
     * @param $vote
     * @return RedirectResponse
     */
    public function vote($post_id, $vote)
    {
        $post = Post::with('community')->findOrFail($post_id);

        if (!PostVote::where([['post_id', $post_id], ['user_id', auth()->id()]])->count()
            && in_array($vote, [-1, 1]) && $post->user_id != auth()->id()) {
            PostVote::create([
                'post_id' => $post_id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);
        }
        return to_route('communities.show', $post->community);
    }

    /**
     * Report the specified resource from storage.
     *
     * @param $post_id
     * @return RedirectResponse
     */
    public function report($post_id)
    {
        $post = Post::with('community.user')->findOrFail($post_id);

        $post->community->user->notify(new PostReportNotification($post));

        return to_route('communities.posts.show', $post)
            ->with('message', 'Your report has been sent!');
    }
}
