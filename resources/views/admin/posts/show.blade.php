@extends('admin.layouts.app')

@section('title', 'Visualização Posts')

@section('content')

<h1>Titulo: {{ $post->title }}</h1>

<ul>
    <li>{{ $post->title }}</li>
    <li>{{ $post->content }}</li>
    <li>{{ $post->created_at }}</li>
</ul>

<form action="{{ route('posts.destroy', $post->id ) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="delete">
    <button type="submit">Deletar {{ $post->title }}</button>
</form>

@endsection
