@extends('adminlte::page')

@section('js')
    <script src="{{ asset('js/backend.js') }}"></script>
@stop

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">New option group</h1>
        </div>

        <div class="box-body">
            <form method="post" action="{{ route('optiongroup.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <input type="button" id="addOptionField" value="Create option">
                    <label for="options">Options</label>
                    <fieldset id="options">

                    </fieldset>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>


    </div>
@stop