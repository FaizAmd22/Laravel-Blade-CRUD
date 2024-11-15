@extends('layouts.app')

@section('title', 'Blog! cok')

@section('content')
    @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(session()->has('error_message'))
        <div class="alert alert-danger">
            {{ session()->get('error_message') }}
        </div>
    @endif
    
    <div style="width:100%;" class="flex justify-content-between align-items-center pt-4">
        <h1>Blog Gem!</h1>
        <a href="{{ url("posts/create") }}" style="width:20px height:20px;" class="btn btn-primary">+ Tambah post</a>
    </div>

    <div class="flex flex-col gap-5" style="padding:20px 0px;">
        @php($number = 1)
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text" style="color:gray;">Last updated {{ date("d M Y H:i", strtotime($post->updated_at))}}</p>
                    <a href="{{ url("posts/$post->id") }}" class="btn btn-primary">Selengkapnya</a>
                    <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
            @php($number++)
        @endforeach
    </div>
@endsection