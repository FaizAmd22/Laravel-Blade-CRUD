@extends('layouts.app')

@section('title', 'Blog | Buat Postingan')

@section('content')
    @if(session()->has('error_message'))
    <div class="alert alert-danger">
        {{ session()->get('error_message') }}
    </div>
    @endif

    <h1>Buat Postingan Baru</h1>

    <form method="POST" action="{{ url("posts") }}" class="form-control">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul disini" value="{{ session('oldTitle') }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Masukkan konten disisni">{{ session('oldContent') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection