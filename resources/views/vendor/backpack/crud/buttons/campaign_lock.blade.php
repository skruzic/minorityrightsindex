@if ($entry->locked)
    <a href="{{ url($crud->route .'/'.$entry->getKey()) }}/lock" class="btn btn-sm btn-link"><i class="la la-unlock"></i> Unlock</a>
@else
    <a href="{{ url($crud->route .'/'.$entry->getKey()) }}/lock" class="btn btn-sm btn-link"><i class="la la-lock"></i> Lock</a>
@endif
