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
            <h1>Añadir Post</h1>
            <form action="{{ url('post') }}" method="post" class="form" id="form">
                @csrf
                <div class="form-input-container">
                    <label for="subject">Asunto</label>
                    <input type="text" name="subject" id="subject" placeholder="subject post" required class="form-input" minlenght="2" maxlenght="50" value="{{ old('subject') }}">
                </div>
                <div class="form-input-container">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" placeholder="content Post" class="form-input">{{ old('content') }}</textarea>
                </div>
                <div class="form-input-container" id="habilidadesSelect">
                    <p>Pokemon:</p>
                    <select name="idpokemon">
                        <option value=""></option>
                        @foreach ($pokemons as $pokemon)
                            <option value="{{ $pokemon->id }}" @if (old('idpokemon') == $pokemon->id) selected @endif >{{ $pokemon->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Crear Post" id="form-button" class="form-button">
            </form>
            <a href="{{ url('post') }}" class='btn btn-info'>Cancelar</a>
        </div>        
    </div>
</div>

@stop