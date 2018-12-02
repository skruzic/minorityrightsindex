@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">Questions</h1>
            <a href="{{ route('campaign.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new question</a>
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
                            <td>{{ $question->type }}</td>
                            <td>
                                <ul>
                                    @foreach ($question->questions as $q)
                                        <li>{{ $q }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @foreach ($question->options as $opt)
                                    <li>{{ $opt }}</li>
                                @endforeach
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