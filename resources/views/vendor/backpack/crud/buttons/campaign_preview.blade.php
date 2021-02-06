@if (!$entry->locked)
    <a href="{{ url('campaign/preview/'.$entry->slug) }}" class="btn btn-sm btn-link" target="_blank"><i
            class="la la-desktop"></i> Preview</a>
@endif