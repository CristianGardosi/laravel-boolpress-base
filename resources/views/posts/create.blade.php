@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-5">
            Create a new post
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

        {{-- Quando devo caricare un flie img, pdf ecc devo esplicitare l'enctype affinchè funzioni --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="body">Corpo dell'articolo</label>
                {{-- Textarea per avere campo di testo espanso adatto per un testo più lungo --}}
                <textarea cols="1" rows="4" class="form-control"  name="body" id="body">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <label for="path_img">Post image</label>
                {{-- Input per inserimento file img --}}
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/">
            </div>
            {{-- Checkbox tags --}}
            <p>Tags</p>
            <div class="form-group">
                @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}">
                    <label for="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <input class="btn btn-primary mt-2 " type="submit" value="Create new post">
            </div>
        </form>
    
    </div>
@endsection