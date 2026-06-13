<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_first_name' => ['required', 'string', 'max:100'],
            'donor_last_name'  => ['required', 'string', 'max:100'],
            'donor_email'      => ['required', 'email', 'max:255'],
            'donor_phone'      => ['nullable', 'string', 'max:30'],
            'donor_pan'        => ['nullable', 'string', 'max:10', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
            'donor_address'    => ['nullable', 'string', 'max:500'],
            'amount'           => ['required', 'numeric', 'min:1'],
            'payment_method'   => ['required', 'string', 'in:online,offline,test'],
            'cause_id'         => ['nullable', 'integer', 'exists:causes,id'],
            'message'          => ['nullable', 'string', 'max:2000'],
        ];
    }
}
