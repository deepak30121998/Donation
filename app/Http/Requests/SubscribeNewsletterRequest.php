<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscribeNewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                // Only block emails that are already actively subscribed.
                // Inactive (unsubscribed) emails are allowed through so the
                // action can reactivate them without a confusing error.
                Rule::unique('newsletter_subscribers', 'email')
                    ->where(fn ($q) => $q->where('is_active', true)),
            ],
        ];
    }
}
