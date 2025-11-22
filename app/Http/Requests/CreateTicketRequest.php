<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => $this->sanitizePhone($this->phone),
            ]);
        }
    }

    protected function sanitizePhone($phone): array|string|null
    {
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        if (str_starts_with($phone, '8') && strlen($phone) === 11) {
            return '+7' . substr($phone, 1);
        }

        if (!str_starts_with($phone, '+')) {
            return '+' . $phone;
        }

        return $phone;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'min:4', 'max:255'],
            'description' => ['required', 'string'],

            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number must be in international type +77771234567.',
        ];
    }
}
