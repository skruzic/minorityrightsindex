@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'      => 'div',
        'class'     => 'row',
        'content'   => [
            [
                'type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => \App\Models\User::count(),
                'description'   => 'Users',
                'progress'      => 100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],
            [
                'type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => \App\Models\Campaign::count(),
                'description'   => 'Campaigns',
                'progress'      => 100, // integer
                'progressClass' => 'progress-bar bg-info',
            ],
            [
                'type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => \App\Models\Question::count(),
                'description'   => 'Questions',
                'progress'      => 100, // integer
                'progressClass' => 'progress-bar bg-warning',
            ],
            [
                'type'        => 'progress_white',
                'class'       => 'card mb-2',
                'value'       => \App\Models\Response::count(),
                'description' => 'Campaign responses',
                'progress'    => 100, // integer
                'progressClass' => 'progress-bar bg-dark',
            ],
        ]
    ];
@endphp

@section('content')
    <p>Your custom HTML can live here</p>
@endsection
