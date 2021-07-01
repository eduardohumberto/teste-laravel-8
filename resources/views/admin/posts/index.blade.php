@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')
    @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
    @endif

    <h1>Posts</h1>

    <form action="{{ route('posts.search') }}" method="post">
    @csrf
    <input type="text" name="search" placeholder="Filtrar">
    <button type="submit">Enviar</button>
    </form>

    <a href="{{ route('posts.create') }}">Criar novo Post</a>
    <hr>

    @foreach ($posts as $post)
    <p>
        <img src="{{ url("storage/$post->image")}}" alt="{{ $post->title }}" style="width: 100px;height: 100px;">
        {{ $post->title }} -
        <a href="{{ route('posts.show', $post->id) }}">Ver Detalhes</a> -
        <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
    </p>
    @endforeach

    <hr>
    @if (isset($filters))
    {{ $posts->appends($filters)->links() }}
    @else
    {{ $posts->links() }}
    @endif

@endsection
