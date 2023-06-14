<div {{ $attributes->merge(['class' => 'dashboard-btn-container px-0 px-lg-2 col-12 mb-3 df-custom-rounded']) }}>
    <a class="fs-5 dashboard-btn mx-1 py-4 px-2 px-lg-4 shadow df-custom-rounded" href="{{ route($link) }}">
        <span><i class="fa-solid fa-{{$icon}} me-2 fa-xl"></i></span>
        <span>{{ $label }}</span>
    </a>
</div>
