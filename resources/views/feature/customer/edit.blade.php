@extends('layouts.master.index')
@push('title', 'Edit')
@push('subtitle', 'Edit')
@push('description', 'Edit customer')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('customer.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <form action="{{ route('customer.update', $customer->id) }}" method="post" class="form-input">
        @csrf
        @method('PUT')
        <div class="row d-flex justify-content-center align-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-inner">
                        <div class="mb-4">
                            <label class="form-label required">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="name" class="form-control @error('name') error @enderror" value="{{ old('name', $customer->name) }}">
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> string | maks : 225 </span>
                                @include('layouts.components.error-input', ['name' => 'name'])
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" name="phone" class="form-control @error('phone') error @enderror" value="{{ old('phone', $customer->phone) }}">
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> number </span>
                                @include('layouts.components.error-input', ['name' => 'phone'])
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required">Address</label>
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea name="address" class="form-control no-resize @error('address') error @enderror" id="default-textarea">{{ old('address', $customer->address) }}</textarea>
                                </div>
                            </div>
                            <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> string </span>
                            @include('layouts.components.error-input', ['name' => 'address'])
                        </div>
                    </div>
                </div>
                @can('customers-update')
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                    </div>
                @endcan
            </div>
        </div>
    </form>
</div>
@endsection



