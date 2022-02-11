@component('mail::message')
# Boas Vindas

Novo orçamento solicitado no site. 

@component('mail::button', ['url' => config('app.url')])
Acessar o Site
@endcomponent

Obrigado,
{{ config('app.name') }}
@endcomponent