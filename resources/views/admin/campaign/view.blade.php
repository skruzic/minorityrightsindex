@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">{{ $campaign->title }}</h1>
            <p>{{ $campaign->description }}</p>
        </div>

        <div class="box-body">
            @if (!empty($campaign->questions))
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Type</th>
                        <th>Question(s)</th>
                        <th>Options</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($campaign->questions as $question)
                            <tr>
                                <td>{{ $question->type }}</td>
                                <td>
                                    <ul>
                                    @foreach (unserialize($question->questions) as $q)
                                        <li>{{ $q }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach (unserialize($question->options) as $opt)
                                            <li>{{ $opt }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $question->pivot->order }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


    </div>
@stop