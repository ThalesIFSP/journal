@extends('layouts.main')

@section('title', 'Editando:' . $journal->title)
@section('content')

    <div id="journal-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{ $journal->title }}</h1>
        <form action="/journals/update/{{ $journal->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem do periódico: </label>
                <input type="file" id="image" name="image" class="from-control-file">
                <img src="/img/journals/{{ $journal->image }}" alt="{{ $journal->name }}" class="img-preview">
            </div>

            <div class="form-group">
                <label for="name">Periódico: </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do periódico"
                    value="{{ $journal->name }}">
            </div>

            <div class="form-group">
                <label for="publisher">Editora: </label>
                <input type="text" class="form-control" id="publisher" name="publisher"
                    placeholder="Editora do periódico" value="{{ $journal->publisher }}">
            </div>

            <div class=" form-group">
                <label for="area">Área de conhecimento: </label>
                <select name="area" id="area" class="form-control">
                    <option value="Tecnologia da Informação"
                        {{ $journal->area == 'Tecnologia da Informação' ? "selected='selected'" : '' }}>Tecnologia da
                        Informação</option>
                    <option value="Robótica" {{ $journal->area == 'Robótica' ? "selected='selected'" : '' }}>Robótica
                    </option>
                    <option value="Inteligência Artificial"
                        {{ $journal->area == 'Inteligência Artificial' ? "selected='selected'" : '' }}>Inteligência
                        Artificial</option>
                    <option value="Desenvolvimento de Sistema"
                        {{ $journal->area == 'Desenvolvimento de Sistema' ? "selected='selected'" : '' }}>Desenvolvimento
                        de
                        Sistema</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Introdução: </label>
                <textarea name="description" id="editor" class="form-control" placeholder="Escreva um pouco do seu periódico...">{{ $journal->description }}</textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Editar periódico">

        </form>
    </div>

@endsection
