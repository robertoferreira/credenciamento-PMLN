@component('mail::message')
Obriado por se cadastrar **{{$company->name_business}}**. Favor acesse a plataforma para verificar se o seu cadastro.

@component('mail::button', ['url' => 'https://credenciamento.lagoanova.rn.gov.br/admin/company'])
Acessar a Plataforma
@endcomponent

Para mais informações entre em contato pelo e-mail cpl@lagoanova.rn.gov.br

{{ config('app.name') }}
@endcomponent


