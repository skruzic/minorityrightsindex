@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">Campaigns</h1>
            <a href="{{ route('campaign.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new campaign</a>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Last modified</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->title }}</td>
                            <td>{{ $campaign->user->name }}</td>
                            <td>{{ $campaign->updated_at }}</td>
                            <td>
                                <a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@stop