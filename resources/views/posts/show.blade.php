@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ $post->title }}</div>

        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-info">{{session('message')}}</div>
            @endif

            @if(!empty($post->post_url))
                <div class="mb-2">
                    <a href="{{$post->post_url}}" target="_blank">{{$post->post_url}}</a>
                </div>
            @endif

            @if(!empty($post->post_image))
                <img src="{{asset('storage/' . $post->post_image)}}" class="w-25" alt=""/>
                <br/><br/>
            @endif

            {{$post->post_text}}

            @auth
                <hr/>
                <h3>Comments</h3>
                @forelse($post->comments as $comment)
                    <b>{{$comment->user->name}}</b>
                    <br/>
                    {{$comment->created_at->diffForHumans()}}
                    <p class="mt-2">{{$comment->comment_text}}</p>
                @empty
                    <h4>No Comments Yet...!!</h4>
                @endforelse
                <hr/>
                <form method="POST" action="{{route('posts.comments.store', $post)}}">
                    @csrf
                    Add a comment:
                    <br/>
                    <textarea class="form-control" name="comment_text" rows="5" required></textarea>
                    <br/>
                    <button class="btn btn-sm btn-primary" type="submit">Add Comment</button>
                </form>
                <hr/>
                @can('edit-post', $post)
                    <a href="{{route('communities.posts.edit', [$post->community, $post])}}"
                       class="btn btn-sm btn-primary">Edit Post</a>
                @endcan

                @can('delete-post', $post)
                    <form action="{{route('communities.posts.destroy', [$post->community, $post])}}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are You Sure?')">Delete Post
                        </button>
                    </form>
                @else
                    <form action="{{route('post.report', $post->id)}}" method="POST"
                          class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are You Sure?')">Report Post as Inappropriate
                        </button>
                    </form>
                @endcan

            @endauth
        </div>
    </div>

@endsection
