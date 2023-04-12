@extends('layouts.master.index')
@push('title', 'Create')
@push('subtitle', 'Create')
@push('description', 'Create order')
@push('tools')
    @include('layouts.components.back-button', ['url' => route('order.index')])
@endpush
@section('content')
<div class="nk-block nk-block-lg" id="no-sidebar">
    <div class="row g-gs">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="row mb-4">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Customer</h6>
                                <div>Please select the customer first</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label required">Customer</label>
                            <div class="form-control-wrap @error('customer_id') border border-danger rounded @enderror">
                                <select name="customer_id" class="form-control js-select2" id="select-customer" data-search="on" required>
                                    <option selected disabled>choose one</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}" {{ (old('customer_id') == $customer->id) ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @include('layouts.components.error-input', ['name' => 'customer_id'])
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="default-01">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control address" id="customer-address" placeholder="Address">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Order date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input type="text" class="form-control date-picker" id="order-date" data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="text-end form-note"><code>if not set, this will set date now</code></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Items detail</h6>
                                <div id="submit-message"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span class="sub-text">Customer ID :</span>
                            <span class="text-primary" id="customer-id">-</span>
                        </div>
                        <div class="mb-2 parent-items"></div>
                        <div class="text-center">
                            <button class="btn btn-lg btn-mw btn-primary" id="generate-invoice">
                                <span>Create invoice</span>
                                <em class="icon ni ni-chevrons-right"></em>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade zoom" data-bs-backdrop="static" tabindex="-1" id="createinvoice">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Invoice</h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Customer ID</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="ic-id" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" >Item selected</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="ic-item" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Subtotal</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="ic-subtotal" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Discount</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 set-discount${el.id}" id="ic-discount" data-search="off">
                                                @for($i=0; $i<=100; $i++)
                                                    <option value={{$i}}>{{ $i }} %</option>
                                                @endfor
                                            </select>
                                            <div id="ic-discount-message"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="ic-total" readonly disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <button type="submit" class="btn btn-lg btn-primary" id="submit-btn-order">Save order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8" id="item-list">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-2">
                        <div class="card-title">
                            <h6 class="title">Items list</h6>
                            <div class="">List of item. You can change qty number and checklist the item</div>
                            <div id="message"></div>
                        </div>
                    </div>
                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check"></th>
                                <th class="nk-tb-col"><span class="sub-text">Code</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Price</span></th>
                                <th class="nk-tb-col nk-tb-col-tools" style="max-width: 100px"><span class="sub-text">Qty</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="nk-tb-item body-item" id="{{ $item->id }}">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input checkbox" id="uid{{$item->id}}">
                                            <label class="custom-control-label" for="uid{{$item->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col"><span class="text-primary">#{{ $item->id }}</span></td>
                                    <td class="nk-tb-col tb-col-md name">{{ Str::limit($item->name, 30, '...') }}</td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="tb-amount price">{{ to_rupiah($item->price) }}</span>
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools" style="max-width: 100px">
                                        <div class="form-group w-100">
                                            <div class="form-control-wrap number-spinner-wrap">
                                                <a class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></a>
                                                <input type="number" class="form-control number-spinner qty" value="1" min="1">
                                                <a class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ url('assets/js/order.js') }}"></script>
@endpush


