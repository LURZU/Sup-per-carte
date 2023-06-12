<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Card') }}</div>

                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        @livewire('programme.dynamic-matiere-select' , ['cardLevels' => $cardLevels] )
                              

                    </form>

   
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
