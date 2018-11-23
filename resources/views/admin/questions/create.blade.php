@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">New question</h1>
        </div>

        <div class="box-body">
            <form method="post" action="{{ route('question.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="campaign_id">Campaign</label>
                    <select class="form-control">
                        @foreach ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="questions">Questions</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop