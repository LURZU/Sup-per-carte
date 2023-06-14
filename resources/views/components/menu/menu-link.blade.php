<div {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ route($route) }}" class="d-flex align-content-center text-decoration-none text-white mb-2 hover-bg  mb-3 @yield($active)"><i class="fa-solid fa-{{$icon}} m-2"></i><span>{{ __($label) }}</span></a>
</div>
