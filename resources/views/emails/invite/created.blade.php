<div>
    {!! $invite->campaign->messages['email_before'] !!}
    {{ url('/campaign/'.$invite->campaign->slug.'?token='.$invite->token) }}
    {!! $invite->campaign->messages['email_after'] !!}
</div>
