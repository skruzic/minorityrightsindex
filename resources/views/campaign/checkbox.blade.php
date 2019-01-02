<div class="form-group">
    @if (!$q->hasChildren())
        <label>{{ $q->question }}</label>
        @foreach ($q->options->options as $val=>$text)
            <label class="checkbox-inline">
                <input type="checkbox" value="{{ $val }}" name="question-{{$q->id}}[]"> {{ $text }}
            </label>
        @endforeach
    @else
        <table class="table table-striped">
            <thead>
                <th></th>
                @foreach ($q->options->options as $opt)
                    <th>{{ $opt }}</th>
                @endforeach
            </thead>
            <tr>
                <td>{{ $q->question }}</td>
                @foreach ($q->options->options as $val=>$text)
                    <td class="checkbox-inline">
                        <input type="checkbox" value="{{ $val }}" name="question-{{$q->id}}[]">
                    </td>
                @endforeach
            </tr>
            @foreach($q->children as $child)
                <tr>
                    <td>{{ $child->question }}</td>
                    @foreach ($q->options->options as $val=>$text)
                        <td class="checkbox-inline">
                            <input type="checkbox" value="{{ $val }}" name="question-{{$child->id}}[]">
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    @endif
</div>