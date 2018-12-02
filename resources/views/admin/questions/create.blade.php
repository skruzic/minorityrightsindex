@extends('adminlte::page')

@section('js')
    <script src="{{ asset('js/backend.js') }}"></script>
@stop

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">New question</h1>
        </div>

        <div class="box-body">
            <form method="post" action="{{ route('question.store') }}">
                {{ csrf_field() }}
                <!--<div class="form-group">
                    <label for="campaign_id">Campaign</label>
                    <select class="form-control">
                        @foreach ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
                        @endforeach
                    </select>
                </div>-->
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type">
                        <option value="radio">Choice</option>
                        <option value="checkbox">Multiple choice</option>
                        <option value="text">Text</option>
                    </select>
                </div>
                <div>
                    <input type="button" id="addQuestionField" value="Create field">
                    <label for="">Questions</label>
                    <fieldset id="questions">

                    </fieldset>
                </div>
                <div class="form-group">
                    <input type="button" id="addOptionField" value="Create field">
                    <label for="options">Options</label>
                    <fieldset id="options">

                    </fieldset>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop