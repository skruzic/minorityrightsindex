@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">Campaigns</h1>
        </div>

        <div class="box-body">
            <form method="post" action="{{ route('campaign.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop