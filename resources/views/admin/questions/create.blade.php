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
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type">
                        <option></option>
                        @foreach ($types as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="question">Question</label>
                    <input type="text" name="question" class="form-control">
                </div>
                <div class="form-group">
                    <label for="option_group">Options</label>
                    <select name="option_group_id" class="form-control">
                        <option></option>
                        @foreach ($ogs as $og)
                            <option value="{{ $og->id }}">{{ $og->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop