@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Most Popular Posts') }}</div>

                <div class="card-body">
                    @foreach($posts as $post)
                        <div class="row">
                            <div class="col-1 text-center">
                                <div>
                                    <a href="{{route('post.vote', [$post->id, 1])}}"><i
                                            class="fa-solid fa-sort-up fa-2x"></i></a>
                                </div>
                                <h2 class="fw-bold">{{$post->votes}}</h2>
                                <div><a href="{{route('post.vote', [$post->id, -1])}}"><i
                                            class="fa-solid fa-sort-down fa-2x"></i></a></div>
                            </div>
                            <div class="col-11">
                                <a href="{{route('communities.posts.show',[$post->community, $post])}}">
                                    <h2>{{$post->title}}</h2></a>
                                <p>{{$post->created_at->diffForHumans()}}</p>
                                <p>{{Str::words($post->post_text, 10)}}</p>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                </div>
            </div>
@endsection
