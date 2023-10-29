@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Random Image') }}</div>

                <div id="image-container" class="card-body">
                    <img id="image" src="" alt="">
                </div>
                <div class="card-footer">
                    <button class="btn btn-success image-action" data-status="{{ \App\Domain\Entities\Image\ImageStatusEnum::ACCEPTED->value }}">Accept</button>
                    <button class="btn btn-danger image-action" data-status="{{ \App\Domain\Entities\Image\ImageStatusEnum::REFUSED->value }}">Refuse</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
