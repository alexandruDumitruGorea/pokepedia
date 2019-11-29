@extends('index')

@section('content')

@isset($tipo)
    <div class="alert alert-{{ $tipo }}" role="alert">
      {{ $mensaje }}
    </div>
@endisset

    <div class="posts-container">
        <div class="container">
            <div class="posts">
                @foreach ($posts as $post)
                    <div class="post-item">
                        <div class="post-header">
                            <h2 class="post-title">{{ $post->subject }}</h2>
                            <div class="pokemon-options">
                                <div class="pokemon-option pokemon-option_more">
                                    <a class="pokemon-option-link" href="{{ url('post/' . $post->id) }}">
                                        <img src="{{ url('assets/img/view.svg') }}" alt="">
                                        <span>Ver</span>
                                    </a>
                                </div>
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
                            @php($count=0)
                            @foreach ($comments as $comment)
                                @if($comment->idpost == $post->id)
                                    @php($count++)
                                @endif
                            @endforeach
                            <img class="icon-comments" src="{{ url('assets/img/icono-comments.svg') }}" alt=""><span>{{ $count }}</span><div href="#" class="view-comentarios">Ver Comentarios</div>
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
                @endforeach
                <a href="{{ url('post') }}" class="button_add">Ver todos los posts</a>
                <p></p>
                {{ $posts->links() }}
                <p></p>
                @auth
                    <a href="{{ url('post/create') }}" class="button_add">Añadir posts</a>
                @endauth
            </div>
        </div>
    </div>

@endsection