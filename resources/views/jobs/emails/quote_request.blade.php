@component('mail::message')
# Olá, seu infeliz!

Tem orçamento novo no site:

O cliente {{$quote->name}} solicitou orçamento para {{$quote->date}} às {{$quote->time}} no {{$quote->place}} em {{$quote->city}} com o projeto {{$quote->project->title}}.

@component('mail::button', ['url' => config('app.url').'/admin'])
Acessar o Site
@endcomponent

Saudações petistas,
{{ config('app.name') }}
@endcomponent