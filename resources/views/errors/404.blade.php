@extends('layouts.main')

@section('content')

<div class="container">
    <h1 class="mb-3">Something went wrong!</h1>
    <a href="{{ route('homepage') }}" class="btn btn-primary">
        Come back to the Homepage
    </a>
</div>

@endsection