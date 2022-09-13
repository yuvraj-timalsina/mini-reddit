<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::with('community')->withCount(['postVotes' => function ($query) {
            $query->where('post_votes.created_at', '>', now()->subDays(7))
                ->where('vote', 1);
        }])->orderByDesc('post_votes_count')->paginate(10)->withQueryString();

        return view('home', compact('posts'));
    }
}
