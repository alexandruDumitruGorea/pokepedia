@extends('index')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="pokemon-form">
    <div class="container">
        <div class="form-container">
            <h1>Editar Post</h1>
            <form action="{{ url('post/'. $post->id) }}" method="post" class="form" id="form">
                @csrf
                @method('PUT')
                <div class="form-input-container">
                    <label>ID post</label>
                    <input type="text" value="{{ $post->id }}" disabled>
                </div>
                <div class="form-input-container">
                    <label>ID user</label>
                    <input type="text" value="{{ $post->iduser }}" disabled>
                </div>
                <div class="form-input-container">
                    <label for="subject">Nombre</label>
                    <input type="text" name="subject" id="subject" placeholder="subject post" required class="form-input" minlenght="2" maxlenght="50" value="{{ old('subject', $post->subject) }}">
                </div>
                <div class="form-input-container">
                    <label for="content">content</label>
                    <textarea name="content" id="content" placeholder="content Post" class="form-input">{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="form-input-container" id="habilidadesSelect">
                    <p>Pokemon:</p>
                    <select name="idpokemon">
                        <option value=""></option>
                        @foreach ($pokemons as $pokemon)
                            <option value="{{ $pokemon->id }}" @if (old('idpokemon', $post->idpokemon) == $pokemon->id) selected @endif >{{ $pokemon->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Editar Post" id="form-button" class="form-button">
            </form>
            <a href="{{ url('post') }}" class='btn btn-info'>Cancelar</a>
        </div>        
    </div>
</div>

@stop