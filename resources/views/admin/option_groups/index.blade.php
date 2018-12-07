@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">Option groups</h1>
            <a href="{{ route('optiongroup.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new option group</a>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($ogs as $og)
                        <tr>
                            <td>{{ $og->name }}</td>
                            <td>
                                <a href="{{ route('optiongroup.show', $og->id) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i> View</a>
                                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trashphp"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop