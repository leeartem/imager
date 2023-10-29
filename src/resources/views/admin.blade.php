@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin dashboard') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <th scope="row">
                                    <a href="{{$item->sourceUrl}}" target="_blank">{{$item->id}}</a>
                                </th>
                                <td>
                                    @if($item->status === \App\Domain\Entities\Image\ImageStatusEnum::ACCEPTED->value)
                                        <span class="badge bg-success">{{$item->status}}</span>
                                    @elseif($item->status === \App\Domain\Entities\Image\ImageStatusEnum::REFUSED->value)
                                        <span class="badge bg-danger">{{$item->status}}</span>
                                    @else
                                        <span class="badge bg-warning">{{$item->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('image-cancel', $item->id)}}">
                                        <input type="hidden" name="token" value="xyz123">
                                        <input type="hidden" name="status" value="waiting">
                                        <button class="btn btn-primary btn-sm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection
