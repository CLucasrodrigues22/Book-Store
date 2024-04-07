<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookstoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'store_id' => [
                'required',
                'integer',
                Rule::exists('stores', 'id')->where(function ($q) {
                    // Checks if the store_id belongs to an active store 
                    $q->where('active', true);
                }),
                Rule::unique('bookstore')->where(function ($q) {
                    // Check if the book is already associated with another store
                    $q->where('id', $this->input('book_id'));
                }),
            ],
        ];
    }
}
