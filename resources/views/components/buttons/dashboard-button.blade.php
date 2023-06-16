<div {{ $attributes->merge(['class' => 'dashboard-btn-container px-3 px-lg-2 col-12 mb-3 df-custom-rounded-8 w-100']) }}>
    <a class="fs-5 dashboard-btn py-4 shadow df-custom-rounded-8" href="{{ route($link) }}">
        <span><i class="fa-solid fa-{{$icon}} me-2 fa-xl"></i></span>
        <span>{{ $label }}</span>
    </a>
</div>
