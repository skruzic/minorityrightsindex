{{-- Free stand-in for the Backpack PRO repeatable field. Submits name[index][subfield]. --}}
@include('crud::fields.inc.wrapper_start')
    @php
        $subfields = $field['fields'] ?? [];
        $rows = old($field['name'], $field['value'] ?? $field['default'] ?? []);
        if (is_string($rows)) {
            $rows = json_decode($rows, true) ?: [];
        }
        if (! is_array($rows)) {
            $rows = [];
        }
        $rows = array_values($rows);

        $subfieldOptions = [];
        foreach ($subfields as $subfield) {
            $choices = [];
            if (isset($subfield['options']) && is_callable($subfield['options'])) {
                $result = ($subfield['options'])(($subfield['model'])::query());
                $attribute = $subfield['attribute'] ?? 'name';
                foreach ($result as $item) {
                    if (is_object($item) && method_exists($item, 'getKey')) {
                        $choices[$item->getKey()] = data_get($item, $attribute);
                    }
                }
            }
            $subfieldOptions[$subfield['name']] = $choices;
        }
    @endphp

    <label>{!! $field['label'] !!}</label>

    <div data-repeatable-field="{{ $field['name'] }}">
        <div class="repeatable-rows">
            @foreach ($rows as $index => $row)
                <div class="border rounded p-2 mb-2">
                    @foreach ($subfields as $subfield)
                        <div class="mb-2">
                            <label class="form-label">{{ $subfield['label'] ?? $subfield['name'] }}</label>
                            @if (isset($subfieldOptions[$subfield['name']]) && count($subfieldOptions[$subfield['name']]))
                                <select class="form-control" name="{{ $field['name'] }}[{{ $index }}][{{ $subfield['name'] }}]">
                                    <option value="">-</option>
                                    @foreach ($subfieldOptions[$subfield['name']] as $key => $text)
                                        <option value="{{ $key }}" @selected((string) (is_array($row) ? ($row[$subfield['name']] ?? '') : '') === (string) $key)>{{ $text }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input
                                    type="text"
                                    class="form-control"
                                    name="{{ $field['name'] }}[{{ $index }}][{{ $subfield['name'] }}]"
                                    value="{{ is_array($row) ? ($row[$subfield['name']] ?? '') : '' }}"
                                >
                            @endif
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.border').remove()">Remove</button>
                </div>
            @endforeach
        </div>

        <template>
            <div class="border rounded p-2 mb-2">
                @foreach ($subfields as $subfield)
                    <div class="mb-2">
                        <label class="form-label">{{ $subfield['label'] ?? $subfield['name'] }}</label>
                        @if (isset($subfieldOptions[$subfield['name']]) && count($subfieldOptions[$subfield['name']]))
                            <select class="form-control" name="{{ $field['name'] }}[__INDEX__][{{ $subfield['name'] }}]">
                                <option value="">-</option>
                                @foreach ($subfieldOptions[$subfield['name']] as $key => $text)
                                    <option value="{{ $key }}">{{ $text }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control" name="{{ $field['name'] }}[__INDEX__][{{ $subfield['name'] }}]" value="">
                        @endif
                    </div>
                @endforeach
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.border').remove()">Remove</button>
            </div>
        </template>

        <button
            type="button"
            class="btn btn-sm btn-outline-primary"
            onclick="(function (button) {
                var root = button.parentElement;
                var rows = root.querySelector('.repeatable-rows');
                var template = root.querySelector('template');
                var index = rows.children.length;
                var html = template.innerHTML.replaceAll('__INDEX__', index);
                rows.insertAdjacentHTML('beforeend', html);
            })(this)"
        >Add</button>
    </div>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')
