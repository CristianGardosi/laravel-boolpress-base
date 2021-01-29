@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-5">
            Edit: {{ $post->title }}
        </h1>
        {{-- SEZIONE VISUALIZZAZIONE EVENTUALI ERRORI ALL'INVIO DELLA FORM --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
         @endif

        {{-- Quando devo caricare un flie img, pdf ecc devo esplicitare l'enctype affinchè funzioni. Utilizzo id e non slug poichè non ritorna una vista e non ho quindi necessità di essere user friendly --}}
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
            </div>
            <div class="form-group">
                <label for="body">Corpo dell'articolo</label>
                {{-- Textarea per avere campo di testo espanso adatto per un testo più lungo --}}
                <textarea cols="1" rows="4" class="form-control"  name="body" id="body">{{ old('body', $post->body) }}</textarea>
            </div>
            <div class="form-group">
                <label for="path_img">Post image</label>
                {{-- Isset = controllo se img è presente --}}
                @isset($post->path_img)
                    <div class="wrap-image">
                        {{-- INTERNAL IMG --}}
                        {{-- <img width="100" src="{{ asset('storage/' . $post->path_img) }}" alt="{{$post->title}}"> --}}
                        {{-- PLACEHOLDER IMG W/FAKER --}}
                        <img width="100" src=" {{ $post->path_img }} " alt="{{ $post->title }}">
                    </div>
                    <p class="mt-1 mb-1">Change img:</p>
                @endisset
                {{-- Input per inserimento file img --}}
                <input class="form-control d-inline" type="file" name="path_img" id="path_img" accept="image/">
            </div>
            <p>Tags</p>
            <div class="form-group">
                @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}"
                    @if ($post->tags->contains($tag->id))
                    checked
                    @endif>
                    <label for="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <input class="btn btn-primary mt-2" type="submit" value="Update post">
            </div>
        </form>
        <form class="mb-3" action="{{ route('posts.destroy', $post->slug) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    
    </div>
@endsection