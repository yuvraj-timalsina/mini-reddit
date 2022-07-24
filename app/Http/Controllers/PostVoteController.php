<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostVoteRequest;
use App\Http\Requests\UpdatePostVoteRequest;
use App\Models\PostVote;

class PostVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return \Illuminate\Http\Response
     */
    public function show(PostVote $postVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return \Illuminate\Http\Response
     */
    public function edit(PostVote $postVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostVoteRequest  $request
     * @param  \App\Models\PostVote  $postVote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostVoteRequest $request, PostVote $postVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostVote $postVote)
    {
        //
    }
}
