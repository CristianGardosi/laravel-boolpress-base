@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-2">
            {{ $post->title }}
        </h1>
        <h4 class="mb-4">
            Ultimo update:  {{ $post->updated_at->diffForHumans() }}
        </h4>
        <p>
           {{ $post->body }}
        </p>
        {{-- Img show (if present) --}}
        @if(!empty($post->path_img)) 
            {{-- INTERNAL IMG --}}
            {{-- <img width="200" src=" {{ asset ('storage/' . $post->path_img) }} " alt="{{ $post->title }}"> --}}
            {{-- PLACEHOLDER IMG W/FAKER --}}
            <img width="200" src=" {{ $post->path_img }} " alt="{{ $post->title }}">
        @else No image for this specific post
        @endif
        {{-- TAGS --}}
        <section class="tags mt-3">
            <h5>Tags</h5>
            @forelse ($post->tags as $tag)
                <span class="badge badge-primary">
                    {{ $tag->name }}
                </span>
            @empty <p>No actual tags for this post.</p>
            @endforelse
        </section>
        <div class="actions mt-4 mb-4">
            {{-- Edit --}}
            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-primary">
                Edit
            </a>
            {{-- Delete --}}
            <form class="d-inline" action="{{ route('posts.destroy', $post->slug) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>       
    </div>
@endsection