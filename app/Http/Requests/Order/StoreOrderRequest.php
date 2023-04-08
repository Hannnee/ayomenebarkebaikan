<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer.id' => 'required', Rule::exists('customers', 'id'),
            'customer.address' => 'required',
            'order.code' => 'required',
            'order.date' => 'required|date',
            'order.items' => 'required',
            'order.discount' => 'required|numeric',
            'order.subtotal' => 'required|decimal:2',
            'order.total' => 'required|decimal:2'
        ];
    }
}
