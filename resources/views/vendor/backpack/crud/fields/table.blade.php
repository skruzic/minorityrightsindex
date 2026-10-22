{{-- Free stand-in for the Backpack PRO table field. Submits name[index][column]. --}}
@include('crud::fields.inc.wrapper_start')
    @php
        $columns = $field['columns'] ?? [];
        $rows = old($field['name'], $field['value'] ?? $field['default'] ?? []);
        if (is_string($rows)) {
            $rows = json_decode($rows, true) ?: [];
        }
        if (! is_array($rows)) {
            $rows = [];
        }
        $rows = array_values($rows);
        if (count($rows) === 0) {
            $rows[] = array_fill_keys(array_keys($columns), '');
        }
    @endphp

    <label>{!! $field['label'] !!}</label>

    <table class="table table-sm table-bordered mb-2" data-table-field="{{ $field['name'] }}">
        <thead>
            <tr>
                @foreach ($columns as $label)
                    <th>{{ $label }}</th>
                @endforeach
                <th style="width: 1%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                <tr>
                    @foreach ($columns as $column => $label)
                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="{{ $field['name'] }}[{{ $index }}][{{ $column }}]"
                                value="{{ is_array($row) ? ($row[$column] ?? '') : '' }}"
                            >
                        </td>
                    @endforeach
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">Remove</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button
        type="button"
        class="btn btn-sm btn-outline-primary"
        onclick="(function (button) {
            var table = button.previousElementSibling;
            var body = table.querySelector('tbody');
            var index = body.querySelectorAll('tr').length;
            var row = body.querySelector('tr');
            if (!row) return;
            var copy = row.cloneNode(true);
            copy.querySelectorAll('input').forEach(function (input) {
                input.value = '';
                input.name = input.name.replace(/\[\d+\]/, '[' + index + ']');
            });
            body.appendChild(copy);
        })(this)"
    >Add {{ $field['entity_singular'] ?? 'row' }}</button>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')
