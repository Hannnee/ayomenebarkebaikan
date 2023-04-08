@extends('layouts.master.index')
@push('title', 'Detail')
@push('subtitle', 'Detail')
@push('description', 'Detail item')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('item.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-inner">
                    <div class="mb-4">
                        <label class="form-label">Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" value="{{ $item->name }}" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Price</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" value="{{ to_rupiah($item->price) }}" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" id="default-textarea">{{ $item->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Created</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control text-capitalize" value="{{ $item->created_time() }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



