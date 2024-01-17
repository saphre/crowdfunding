<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for saving.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function store(): array
    {
        return [
            'user_id' => 'required',
            'category_id' => 'required',
            'currency_id' => 'required',
            'title' => 'required|unique:donations',
            'description' => 'required',
            'donation_img' => ['required'],
            'type' => 'required',
            'target_amount' => 'required',
        ];
    }

     /**
     * Get the validation rules that apply to the request for an update.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function update(): array
    {
        return [
            'user_id' => 'required',
            'category_id' => 'required',
            'currency_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'donation_img' => ['required'],
            'type' => 'required',
            'target_amount' => 'required',
        ];
    }
}
