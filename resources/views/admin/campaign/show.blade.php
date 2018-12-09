@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">{{ $campaign->title }}</h1>
            <p>{{ $campaign->description }}</p>
            <a href="{{ route('campaign.section.create', $campaign->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> Add new section</a>
        </div>

        <div class="box-body">
            @if (!empty($campaign->sections))
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Section</th>
                        <th>Order <button class="btn fa fa-save"></button></th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($campaign->sections as $section)
                            <tr>
                                <td>{{ $section->title }} <span class="badge">{{ count($section->questions) }}</span></td>
                                <td><input type="text" value="{{ $section->order }}"></td>
                                <td><a href="{{ route('campaign.section.show', [$campaign->id, $section->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i> View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


    </div>
@stop