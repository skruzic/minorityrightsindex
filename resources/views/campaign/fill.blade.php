@extends('layouts.app')

@section('footer')
    <script>
        var form = $("#campaign-form");

        form.children('div').steps({
            headerTag: "h3",
            bodyTag: "section",

        });
    </script>
@endsection

@section('content')
    <h1>{{ $campaign->title }}</h1>
    <form method="post" action="{{ route('campaign.save') }}" id="campaign-form">
        <div>
            {{ csrf_field() }}
            @foreach ($campaign->sections as $section)
                <tab-content title="{{ $section->title }}" description="{{ $section->description }}">
                    <h4>Pitanja:</h4>
                    @foreach($section->questions()->withoutChildren()->get() as $q)
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
                                @include('campaign.panel', ['panel'=>json_decode($q->question, true)])
                                @break
                        @endswitch
                    @endforeach
                </tab-content>
            @endforeach
        </div>
    </form>
@endsection

