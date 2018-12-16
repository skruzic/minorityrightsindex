@extends('layouts.main')

@section('content')
    <h1>{{ $campaign->title }}</h1>

    @foreach ($campaign->sections as $section)
        <h3>Sekcija: {{ $section->title }}</h3>
        <p>{{ $section->description }}</p>
        <h4>Pitanja:</h4>

        @foreach($section->questions as $q)
            @switch($q->type)
                @case(0)
                    @include('campaign.text', ['q'=>$q])
                    @break
                @case(1)
                    @include('campaign.textarea',['q'=>$q])
                    @break
                @case(2)
                    @include('campaign.radio', ['q'=>$q])
                    @break
                @case(3)
                    @include('campaign.checkbox', ['q'=>$q])
                    @break
                @case(4)
                Za napraviti
            @endswitch
        @endforeach
    @endforeach

@endsection

