@extends('layouts.main')

@section('content')
    <h1>{{ $campaign->title }}</h1>

    @foreach ($campaign->questions as $q)
        @if (count($q->questions)==1)

        @else

        @endif
    @endforeach

@endsection

