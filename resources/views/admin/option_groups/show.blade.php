@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">{{ $og->name }}</h1>
            <p>{{ $og->description }}</p>
        </div>

        <div class="box-body">
            @if (count($og->options) > 0)
                <ul class="list-group">
                    @foreach ($og->options as $option)
                        <li class="list-group-item">{{ $option }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@stop