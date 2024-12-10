<x-mail::message>
{{-- Saudação --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Opa!')
@else
@lang('notifications.password_reset_greeting')
@endif
@endif

{{-- Linhas de Introdução --}}
@lang('notifications.password_reset_intro')

{{-- Botão de Ação --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
@lang('notifications.password_reset_action')
</x-mail::button>
@endisset

{{-- Linhas de Fechamento --}}
@lang('notifications.password_reset_expiration')<br>
@lang('notifications.password_reset_no_action')

{{-- Saudação Final --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('notifications.password_reset_salutation')<br>
{{ config('app.name') }}
@endif

{{-- Subcópia --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Se você está tendo dificuldades para clicar no botão \":actionText\", copie e cole o URL abaixo\n".
    'no seu navegador:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
