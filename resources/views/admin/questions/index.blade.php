@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">Questions</h1>
            <a href="{{ route('question.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new question</a>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <th>Type</th>
                    <th>Questions</th>
                    <th>Options</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->type->display }}</td>
                            <td>{{ $question->question }}</td>
                            <td>
                                @if (!is_null($question->options))
                                    {{ $question->options->name }}
                                @else

                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-default btn-xs"><i class="fa fa-search"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@stop