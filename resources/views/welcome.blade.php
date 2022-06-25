@extends('layouts.main')

@section('title', 'Periódicos IFSP')
@section('content')

    <div id="search-container" class="col-md-10">
        <h1>Buscar Periódico</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
        </form>
    </div>
    <div id="journals-container" class="col-md-12">
        @if ($search)
            <h2>Buscando por: {{ $search }}</h2>
        @else
            <h2>Periódicos Recentes:</h2>
        @endif
        <div id="cards-container" class="row">
            @foreach ($journals as $journal)
                <div class="card col-md-3">
                    <img src="/img/journals/{{ $journal->image }}" alt="{{ $journal->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $journal->name }}</h5>
                        <p class="card-participations">{{ $journal->area }}</p>
                        <p class="card-participations">Publicado por {{ $journal->publisher }}</p>
                        <a href="/journals/{{ $journal->id }}" class="btn btn-primary">Saber Mais</a>
                    </div>
                </div>
            @endforeach
            @if (count($journals) == 0 && $search)
                <p>Não foi possível encontrar nenhum periódico com {{ $search }}!
                    <a href="/">Ver todos</a>
                </p>
            @elseif(count($journals) == 0)
                <p>Não há periódicos disponíveis</p>
            @endif
        </div>
    </div>

@endsection
