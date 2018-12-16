@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h2 class="box-title">{{ $campaign->title }}</h2>
            <p>{{ $campaign->description }}</p>
            <hr>
            <h3 class="box-title">{{ $section->title }}</h3>
        </div>

        <div class="box-body">
            @if (!empty($section->questions))
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Question</th>
                        <th>Type</th>
                        <th>Order <button class="btn fa fa-save"></button></th>
                    </thead>
                    <tbody>
                        @foreach ($section->questions as $question)
                            <tr>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->type }}</td>
                                <td><input type="text" value="{{ $question->pivot->order }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


    </div>
@stop