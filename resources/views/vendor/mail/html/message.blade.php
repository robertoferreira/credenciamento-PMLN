@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
![PMLN]({{ asset('_assets/img/logo-prefeitura-de-lagoa-nova.png') }})
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Prefeitura Municipal de Lagoa Nova/RN.
@endcomponent
@endslot
@endcomponent
