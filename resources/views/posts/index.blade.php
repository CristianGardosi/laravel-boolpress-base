@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-5">
            Blog Archive
        </h1>
        {{-- Messaggio delete elemento user friendly che riderecta su index dando questo avviso --}}
        @if (session('post-deleted'))
            <div class="alert alert-success">
                Post '{{ session('post-deleted') }}'' has been deleted sucessfully
            </div>
        @endif

        @forelse ($posts as $post)
            <article class="mb-3 mt-4">
                <h2>
                    {{ $post->title }}
                </h2>
                <h4 class="mb-3 mt-3">
                    {{ $post->created_at->format('d/m/Y') }}
                </h4>
                <p>
                    {{ $post->body }}
                </p>
                <a href="{{ route('posts.show', $post->slug) }}">
                    Read more / edit or delete this post
                </a>
            </article>
            <hr>
        @empty
            <p>
                {{-- Slug user friendly link --}}
                No post found, <a href="{{ route('posts.create') }}">create a new one.</a>
            </p>
        @endforelse
        {{-- Paginate --}}
        <div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
