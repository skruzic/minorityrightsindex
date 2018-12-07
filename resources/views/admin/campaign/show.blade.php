@extends('adminlte::page')

@section('content')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h1 class="box-title">{{ $campaign->title }}</h1>
            <p>{{ $campaign->description }}</p>
        </div>

        <div class="box-body">
            @if (!empty($campaign->sections))
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Section</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($campaign->sections as $section)
                            <tr>
                                <td>{{ $section->title }} <span class="badge">{{ count($section->questions) }}</span></td>
                                <td>{{ $section->order }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


    </div>
@stop