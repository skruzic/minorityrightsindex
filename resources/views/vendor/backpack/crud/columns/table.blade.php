@php
    $value = data_get($entry, $column['name']);
    if (is_string($value)) {
        $value = json_decode($value, true);
    }
@endphp
@if (is_array($value))
    @foreach ($value as $row)
        <div>{{ is_array($row) ? implode(' — ', array_filter($row, fn ($item) => $item !== null && $item !== '')) : $row }}</div>
    @endforeach
@endif
