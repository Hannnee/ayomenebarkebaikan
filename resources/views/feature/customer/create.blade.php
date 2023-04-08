@extends('layouts.master.index')
@push('title', 'Create')
@push('subtitle', 'Create')
@push('description', 'Create customer')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('customer.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg">
    <form action="{{ route('customer.store') }}" method="post" class="form-input">
        @csrf
        @method('post')
        <div class="row d-flex justify-content-center align-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-inner">
                        <div class="mb-4">
                            <label class="form-label required">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="name" class="form-control @error('name') error @enderror" value="{{ old('name') }}" placeholder="Please input name" required>
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> string | maks : 225 </span>
                                @include('layouts.components.error-input', ['name' => 'name'])
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required">Phone</label>
                            <div class="form-control-wrap">
                                <input type="string" name="phone" class="form-control @error('phone') error @enderror" value="{{ old('phone') }}" placeholder="082212323232" required>
                                <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> number </span>
                                @include('layouts.components.error-input', ['name' => 'phone'])
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required">Address</label>
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea name="address" class="form-control no-resize @error('address') error @enderror" id="default-textarea">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <span class="d-flex justify-content-end mt-1 letter-space-1 fs-12px"> string </span>
                            @include('layouts.components.error-input', ['name' => 'address'])
                        </div>
                    </div>
                </div>
                @can('customers-create')
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                    </div>
                @endcan
            </div>
        </div>
    </form>
</div>
@endsection



