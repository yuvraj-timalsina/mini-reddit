@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h1>{{ $community->name }}</h1>
                            </div>
                            <div class="col-4 text-end">
                                <a href="{{route('communities.show', $community)}}"
                                   @if(request('sort', '')=='') class="fs-4" @endif
                                >Newest Posts</a>
                                <br/>
                                <a href="{{route('communities.show', $community)}}?sort=popular"
                                   @if(request('sort', '')=='popular')class="fs-4"@endif>Popular Posts
                                    </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{route('communities.posts.create', $community)}}" class="btn btn-primary">Add
                            Post</a>
                        <br/><br/>

                        @forelse($posts as $post)
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
                                    <a href="{{route('communities.posts.show',[$community, $post])}}">
                                        <h2>{{$post->title}}</h2></a>
                                    <p>{{$post->created_at->diffForHumans()}}</p>
                                    <p>{{Str::words($post->post_text, 10)}}</p>
                                </div>
                            </div>
                            <hr/>
                        @empty
                            No Posts Found!
                        @endforelse

                        {{$posts->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
