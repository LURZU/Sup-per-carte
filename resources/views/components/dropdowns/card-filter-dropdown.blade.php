<div>
    <button class="btn {{ $model }} fw-bold d-flex justify-content-between align-content-center w-100 text-capitalize" type="button">
        {{ $model }}
        <i class="fa-solid fa-chevron-down mt-1"></i>
    </button>
    <div id="{{ $model }}Checkboxes" class="ms-4 collapse {{ $model }} {{ $show ?? '' }}">
        @foreach ($items as $item)
            <label><input type="checkbox" value="{{$item->id}}"> {{$item->label}}</label><br>
        @endforeach
    </div>
</div>
