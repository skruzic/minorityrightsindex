<table class="table table-striped">
    <thead>
        @foreach($panel['header'] as $th)
            <th>{{ $th }}</th>
        @endforeach
    </thead>
    <tbody>
        @foreach($panel['body'] as $tr)
            <tr>
                @foreach($tr as $td)
                    <td>{{ $td }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>