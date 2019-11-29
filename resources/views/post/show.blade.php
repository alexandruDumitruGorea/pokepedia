@extends('index')
@section('content')

<div class="posts-container">
    <div class="container">
        <div class="posts">
            <div class="post-item">
                <div class="post-header">
                    <h2 class="post-title">{{ $post->subject }}</h2>
                    <div class="pokemon-options">
                        @auth
                            @foreach ($users as $user)
                                @if(Auth::user()->id == $post->iduser || Auth::user()->name == 'Ash')
                                    <div class="pokemon-option pokemon-option_edit">
                                        <a class="pokemon-option-link" href="{{ url('post/' . $post->id . '/edit') }}">
                                            <img src="{{ url('assets/img/edit.svg') }}" alt="">
                                            <span>Editar</span> 
                                        </a>
                                    </div>
                                    <div class="pokemon-option pokemon-option_delete">
                                        <form action="{{ url('post/' . $post->id) }}" method="POST" class="destroy pokemon-option-link">
                                            @csrf
                                            @method('DELETE')
                                            <img src="{{ url('assets/img/recycle-bin.svg') }}" alt="">
                                            <input type="submit" value="Borrar"/>
                                        </form>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                        @endauth
                    </div>
                </div>
                @foreach ($users as $user)
                    @if($user->id == $post->iduser)
                        <div class="post-author"><span>Subido por:</span> {{ $user->name }}</div>
                        @break
                    @endif
                @endforeach
                <div class="post-content">
                    <p>{{ $post->content }}</p>
                </div>
                <div class="post-comentarios">
                    <img class="icon-comments" src="{{ url('assets/img/icono-comments.svg') }}" alt=""><span>{{ $numcomentarios[0]->numComentarios }}</span><div href="#" class="view-comentarios">Ver Comentarios</div>
                    @auth <a href="{{ url('comment/create?idpost=' . $post->id) }}" class="button_add">Añadir Comentario</a> @endauth
                </div>
                <div class="comentarios-container">
                    @foreach ($comments as $comment)
                        @if($comment->idpost == $post->id)
                            <div class="comentario comentario_active">
                                <div class="comentario-header">
                                    <img class="coment-user" src="{{ url('assets/img/user.svg') }}" alt="">
                                    @foreach ($users as $user)
                                        @if($user->id == $comment->iduser)
                                            <p>{{ $user->name }}</p>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                <div class="comentario-content">
                                    <p>{{ $comment->content }}</p>
                                </div>
                                <div class="pokemon-options">
                                    @auth
                                        @foreach ($users as $user)
                                            @if(Auth::user()->id == $comment->iduser || Auth::user()->name == 'Ash')
                                                <div class="pokemon-option pokemon-option_edit">
                                                    <a class="pokemon-option-link" href="{{ url('comment/' . $comment->id . '/edit') }}">
                                                        <img src="{{ url('assets/img/edit.svg') }}" alt="">
                                                        <span>Editar</span> 
                                                    </a>
                                                </div>
                                                <div class="pokemon-option pokemon-option_delete">
                                                    <form action="{{ url('comment/' . $comment->id) }}" method="POST" class="destroy pokemon-option-link">
                                                        @csrf
                                                        @method('DELETE')
                                                        <img src="{{ url('assets/img/recycle-bin.svg') }}" alt="">
                                                        <input type="submit" value="Borrar"/>
                                                    </form>
                                                </div>
                                                @break
                                            @endif
                                        @endforeach
                                    @endauth
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        <a href="{{ url('post') }}" class="button_add">Ver todos los posts</a>
        <p></p>
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class='btn btn-info'>Volver</a>
@stop