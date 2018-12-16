<div class="form-group">
    <label>{{ $q->question }}</label>
    @foreach ($q->options->options as $opt)
        <label class="radio-inline">
            <input type="radio" value="{{ $opt }}"> {{ $opt }}
        </label>
    @endforeach
</div>