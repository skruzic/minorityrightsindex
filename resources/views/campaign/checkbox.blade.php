<div class="form-group">
    <label>{{ $q->question }}</label>
    @foreach ($q->options->options as $opt)
        <label class="checkbox-inline">
            <input type="checkbox" value="{{ $opt }}"> {{ $opt }}
        </label>
    @endforeach
</div>