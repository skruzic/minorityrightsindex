@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h2 class="box-title">{{ $campaign->title }}</h2>
            <p>{{ $campaign->description }}</p>
            <hr>
            <h3 class="box-title">{{ $section->title }}</h3>
            <a href="{{ route('campaign.section.question.create', [$campaign->id, $section->id]) }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new question</a>
        </div>
        <div class="box-body">
            @if (!empty($section->questions))
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Question</th>
                        <th>Type</th>
                        <th>Order <button class="btn fa fa-save"></button></th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($section->questions as $question)
                            <tr>
                                <td>{{ $question->question }}</td>
                                <td>{{ \App\Enums\QuestionType::getDescription($question->type) }}</td>
                                <td><input type="text" value="{{ $question->order }}"></td>
                                <td>
                                    <a href="#" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trashphp"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


    </div>
@stop