@extends('layouts.main')

@section('title', $journal->name)
@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="col-md-12 journal-header">
            <img src="/img/journals/{{ $journal->image }}" alt="{{ $journal->name }}" class="img-fluid" width="200"
                height="300">
            <h1>{{ $journal->name }}</h1>
            <p class="event-owner">
                Autor:
                {{ $journalOwner['name'] }}
            </p>

            <p class="event-city">
                Editora:
                {{ $journal->publisher }}
            </p>
            <p class="events-participants">
                Tema:
                {{ $journal->area }}
            </p>
        </div>
        <div class="col-md-12 clear-img">
            <p class="event-description">{!! $journal->description !!}</p>
        </div>
    </div>

@endsection
