<div {{ $attributes->merge(['class' => 'dashboard-btn-container col-12 mb-3']) }}>
    <a class="fs-5 dashboard-btn mx-1 p-4 shadow" href="{{ route($link) }}">
        <span><i class="fa-solid fa-{{$icon}} me-2 fa-xl"></i></span>
        <span>{{ $label }}</span>
    </a>
</div>
