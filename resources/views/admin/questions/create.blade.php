@extends('adminlte::page')

@section('js')
    <script src="{{ asset('js/backend.js') }}"></script>
    <script src="{{ asset('js/questions.js') }}"></script>
@stop

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">New question</h1>
        </div>

        <div class="box-body">
            <form method="post" action="{{ route('campaign.section.question.store', [$campaign_id, $section_id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type" id="question-type">
                        @foreach ($types as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group hidden" id="question-parent-wrapper">
                    <label for="parent">Parent</label>
                    <select name="parent_id" class="form-control">
                        <option></option>
                        @foreach ($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="question-wrapper">
                    <label for="question">Question</label>
                    <input type="text" name="question" class="form-control">
                </div>
                <div class="form-group hidden" id="question-options-wrapper">
                    <label for="option_group">Options</label>
                    <select name="option_group_id" class="form-control">
                        <option></option>
                        @foreach ($ogs as $og)
                            <option value="{{ $og->id }}">{{ $og->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group hidden" id="csv-upload-wrapper">
                    <label for="csv">CSV upload</label>
                    <input type="file" name="csv">
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop