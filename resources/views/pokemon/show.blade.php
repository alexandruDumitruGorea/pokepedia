@extends('index')
@section('content')

<div class="pokemon-view-container">
    <div class="container">
        <div class="pokemon-container">
            <div class="pokemon-intro">
                <h1>{{$pokemon->nombre}}</h1>
            </div>
            <div class="pokemon">
                <div class="pokemon-img-container">
                    <img src="{{ url('assets/img/pokemons/' . $pokemon->img) }}" alt="" class="pokemon-img">
                </div>
                <div class="pokemon-desc">
                    <div class="pokemon-caracteristicas">
                        <h2>Características</h2>
                        <ul class="pokemon-caracteristicas-list">
                            <li class="pokemon-caracteristica">
                                <p>Altura</p>
                                <p class="black">{{$pokemon->altura}} m</p>
                            </li>
                            <li class="pokemon-caracteristica">
                                <p>Peso</p>
                                <p class="black">{{$pokemon->peso}} kg</p>
                            </li>
                        </ul>
                        <h2>Habilidades</h2>
                        <ul class="pokemon-caracteristicas-list">
                            <li class="pokemon-caracteristica">
                                @foreach ($habilidades as $habilidad)
                                    <p class="black">{{$habilidad}}</p>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="pokemon-options">
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
            <a href="{{ url('post?idpokemon=' . $pokemon->id) }}" class="posts-button button_add">Ver posts relacionados</a>
            <a href="{{ route('pokemon.index') }}" class='btn btn-info'>Volver</a>
        </div>
    </div>
</div>

@stop