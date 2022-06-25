@extends('layouts.main')

@section('title', 'Criar Periódico')
@section('content')
    <div class="row">

        <div id="event-create-container" class="col-md-6">
            <h1>Crie o seu periódico</h1>
            <form action="/journals" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Imagem do Periódico: </label>
                    <input type="file" id="image" name="image" class="from-control-file" accept="image/*"
                        onchange="showPreview(event);">

                </div>

                <div class="form-group">
                    <label for="name">Periódico: </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Nome do Periódico">
                </div>

                <div class="form-group">
                    <label for="publisher">Editora: </label>
                    <input type="text" class="form-control" id="publisher" name="publisher"
                        placeholder="Editora do Periódico">
                </div>

                <div class="form-group">
                    <label for="area">Área de conhecimento: </label>
                    <select name="area" id="area" class="form-control">
                        <option value="Tecnologia da Informação">Tecnologia da Informação</option>
                        <option value="Robótica">Robótica</option>
                        <option value="Inteligência Artificial">Inteligência Artificial</option>
                        <option value="Desenvolvimento de Sistema">Desenvolvimento de Sistema</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Introdução: </label>
                    <textarea name="description" id="editor" class="form-control" placeholder="Escreva um pouco do seu periódico..."></textarea>
                </div>

                <div class="form-group">
                    <label for="signature">Assinatura: </label>
                    <input type="number" class="form-control" id="signature" name="signature"
                        placeholder="Valor Assinatura do Periódico">
                </div>

                <input type="submit" class="btn btn-primary" value="Criar Periódico">

            </form>
        </div>
        <div class="col-md-5" id="event-create-container">
            <img id="img-preview" src="#" alt="Sua imagem aparecerá aqui." width="100%"/>
        </div>
    </div>

@endsection
