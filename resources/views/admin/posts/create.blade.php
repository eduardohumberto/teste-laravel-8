@extends('admin.layouts.app')

@section('title', 'Criação dos Posts')

@section('content')

<h1>Cadastrar Novo Post</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif

<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" id="image">
    <input type="text" name="title" id="title" placeholder="Título" value="{{ old('title') }}">

    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo" >{{ old('content') }}</textarea>
    <button type="submit">Enviar</button>
</form>

@endsection
