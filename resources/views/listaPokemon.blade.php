@extends('index')

@section('content')

@isset($tipo)
    <div class="alert alert-{{ $tipo }}" role="alert">
      {{ $mensaje }}
    </div>
@endisset

<div class="pokemon-list-container">
    <div class="container">
        <div class="pokemon-list">
            <div class="pokemon-intro">
                <h1>Pokepedia</h1>
                <h2>Descubre todo sobre los pokemon</h2>
            </div>
            @foreach ($pokemons as $pokemon)
                <div class="pokemon-item">
                    <div class="pokemon-img-container">
                        <img class="pokemon-img" src="{{ url('assets/img/pokemons/' . $pokemon->img) }}" alt="">
                    </div>
                    <div class="pokemon-info">
                        <div class="pokemon-name">
                            <h1>{{ $pokemon->nombre }}</h1>
                        </div>
                        <div class="pokemon-options">
                            <div class="pokemon-option pokemon-option_more">
                                <a class="pokemon-option-link" href="{{ url('pokemon/' . $pokemon->id) }}">
                                    <img src="{{ url('assets/img/view.svg') }}" alt="">
                                    <span>Ver</span>
                                </a>
                            </div>
                            @auth
                                @if (Auth::user()->name == 'Ash')
                                    <div class="pokemon-option pokemon-option_edit">
                                        <a class="pokemon-option-link" href="{{ url('pokemon/' . $pokemon->id . '/edit') }}">
                                            <img src="{{ url('assets/img/edit.svg') }}" alt="">
                                            <span>Editar</span> 
                                        </a>
                                    </div>
                                    <div class="pokemon-option pokemon-option_delete">
                                        <form action="{{ url('pokemon/' . $pokemon->id) }}" method="POST" class="destroy pokemon-option-link">
                                            @csrf
                                            @method('DELETE')
                                            <img src="{{ url('assets/img/recycle-bin.svg') }}" alt="">
                                            <input type="submit" value="Borrar"/>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
            <p></p>
            {{ $pokemons->links() }}
            @auth
                <a href="{{ url('pokemon/create') }}" class="button_add">Añadir Pokemon</a>
            @endauth
        </div>
    </div>
</div>

@endsection