@component('mail::message')
Obrigado por se cadastrar **{{$company->name_business}}**. Favor acesse a plataforma para verificar o seu cadastro.

@component('mail::button', ['url' => 'http://lagoanova-laravel.local/admin/company'])
Acessar a Plataforma
@endcomponent

Para mais informações entre em contato pelo e-mail **cpl@lagoanova.rn.gov.br** ou ligue para (84) 3437- 2232.

Atenciosamente,
{{ config('app.name') }}

@endcomponent
