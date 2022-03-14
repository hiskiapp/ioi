<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentConfirmationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transactions_id' => 'required|exists:transactions,id',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sender_name' => 'required|string|max:255',
        ];
    }
}
