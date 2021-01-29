<header class="mb-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        {{-- Home link --}}
        <a class="navbar-brand" href="{{ route('homepage') }}">
            BLOG DB
        </a>
        {{-- Hamburger --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    {{-- Home link --}}
                    <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    {{-- About link --}}
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    {{-- About link --}}
                    <a class="nav-link" href="{{ route('posts.index') }}">Archivio</a>
                </li>
                <li class="nav-item">
                    {{-- About link --}}
                    <a class="nav-link" href="{{ route('posts.create') }}">Crea post</a>
                </li>
            </ul>
        </div>
    </nav>
</header>