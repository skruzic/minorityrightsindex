@extends('layouts.main')

@section('content')
    <h1>{{ $campaign->title }}</h1>

    @foreach ($campaign->questions as $q)
        @if (count($q->questions)==1)

        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <th>&nbsp;</th>
                    @foreach($q->options as $option)
                        <th>{{ $option }}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($q->questions as $question)
                        <tr>
                            <td>{{ $question }}</td>
                            @foreach($q->options as $option)
                                <!--<td><input type="{{ $q->type }}"></td>-->
                                <td>{{ Form::input($q->type, 'q'.$q->pivot->id) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach

@endsection

