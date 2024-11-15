@extends('layouts.app')

@section('title', "Blog | $post->title")

@section('content')
        <article class="blog-post">
            <h2 class="blog-post-title mb-1">{{$post->title}}</h2>
            <p class="blog-post-meta">{{date("d M Y H:i", strtotime($post->updated_at))}}</p>

            <p>{{$post->content}}</p>

            <small class="text-muted">{{$total_comment}} Komentar</small>

            <div>
                @foreach($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p>{{$comment->comment}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </article>
        <a href="{{url("posts")}}">< Kembali</a>
    </div>
@endsection