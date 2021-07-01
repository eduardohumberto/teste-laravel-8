@extends('admin.layouts.app')

@section('title', 'Edição dos Posts')

@section('content')

<h1>Editar o Post {{ $post->title }}</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="post"enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="file" name="image" id="image">
    <input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title }}">

    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo" >{{ $post->content }}</textarea>
    <button type="submit">Enviar</button>
</form>

@endsection
