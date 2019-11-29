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
            <h1>Añadir Pokemon</h1>
            <form action="{{ url('pokemon') }}" method="post" class="form" id="form" enctype="multipart/form-data">
                @csrf
                <div class="form-input-container">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre pokemon" required class="form-input" minlenght="2" maxlenght="50" value="{{ old('nombre') }}">
                </div>
                <div class="form-input-container">
                    <label for="altura">Altura</label>
                    <input type="number" name="altura" id="altura" placeholder="Altura pokemon" class="form-input" min="0.00" max="9999.99" step="0.01" value="{{ old('altura') }}">
                </div>
                <div class="form-input-container">
                    <label for="peso">Peso</label>
                    <input type="number" name="peso" id="peso" placeholder="Peso pokemon" class="form-input" min="0.00" max="9999.99" step="0.01" value="{{ old('peso') }}">
                </div>
                <div class="form-input-container">
                    <label for="form-input_file">Imagen</label>
                    <input type="file" name="img" id="form-input_file" class="form-input_file hide">
                    <div id="drop-zone" class="drop-zone">
                        <svg version="1.1" id="icono-upload" class="icono-upload" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 357.576 357.576" style="enable-background:new 0 0 357.576 357.576;" xml:space="preserve">
                            <path d="M300.807,88.652l-94.111-77.447C198.805,4.712,185.562,0,175.206,0h-108.5C53.471,0,42.703,10.602,42.703,23.636
                                    c0.002,3.121,0.167,312.155,0.167,313.775c0,11.805,8.258,20.05,20.082,20.05c7.5,0,228.892,0.115,228.892,0.115
                                    c12.914,0,23.029-10.502,23.029-23.909V119.673C314.873,108.403,308.957,95.356,300.807,88.652z M175.206,1c0.003,0,0.007,0,0.01,0
                                    C175.212,1,175.209,1,175.206,1L175.206,1z M240.622,229.454c-1.19,2.289-3.653,3.546-6.587,3.546h-32.162v76.729
                                    c0,4.963-3.887,9.271-8.85,9.271h-27.622c-4.963,0-8.528-4.308-8.528-9.271V233h-32.477c-2.933,0-5.395-1.255-6.586-3.543
                                    c-1.19-2.288-0.897-5.033,0.785-7.435l54.232-77.378c1.551-2.213,3.88-3.469,6.39-3.469c2.512,0,4.841,1.277,6.391,3.49
                                    l54.227,77.349C241.519,224.417,241.813,227.166,240.622,229.454z M204.833,113.959c0.462,0.025,0.934,0.041,1.424,0.041h0
                                    C205.769,114,205.294,113.986,204.833,113.959z M206.257,113c-15.924,0-16.384-14.751-16.384-16.433V30.96L293.844,113H206.257z"/>
                        </svg>
                        <p class="drop-zone-text">Arrastra tu imagen o haz click para subir imagen</p>
                    </div>
                </div>
                <div class="input-image">
                    <div class="eliminar-img">
                        <img src="{{ url('assets/img/recycle-bin.svg') }}" alt="">
                    </div>
                </div>
                <div class="form-input-container" id="habilidadesSelect">
                    <p>Habilidades:</p>
                    <select name="habilidad" required>
                        <option value=""></option>
                        @foreach ($habilidades as $habilidad)
                            <option value="{{ $habilidad->id }}" @if (old('habilidad') == $habilidad->id) selected @endif >{{ $habilidad->ability }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Crear Pokemon" id="form-button" class="form-button">
            </form>
            <a href="{{ url('pokemon') }}" class='btn btn-info'>Cancelar</a>
        </div>        
    </div>
</div>

@stop