<?php

namespace App\Http\Controllers;

use App\Http\Requests\Community\StoreCommunityRequest;
use App\Http\Requests\Community\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::where('user_id', auth()->id())->get();

        return view('communities.index', compact('communities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCommunityRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + ['user_id' => auth()->id()]);
        $community->topics()->attach($request->topics);

        return to_route('communities.show', $community);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('communities.create', compact('topics'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Community $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        return $community->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Community $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }
        $topics = Topic::all();
        $community->load('topics');
        return view('communities.edit', compact('community', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCommunityRequest $request
     * @param \App\Models\Community $community
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return to_route('communities.index')->with(['alert' => 'alert-info', 'message' => 'Successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Community $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        $community->delete();

        return to_route('communities.index')->with(['alert' => 'alert-danger', 'message' => 'Successfully Deleted!']);
    }
}
