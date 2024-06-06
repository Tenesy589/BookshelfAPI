<?php

namespace App\Http\Requests;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string',
            'patronymic' => 'nullable|string',
            'book_ids' => ['required',
                'array',
                function ($attribute, $value, $fail) {
                    if (isset($value) && is_array($value)) {
                        foreach ($value as $bookId) {
                            if (!Author::where('id', $bookId)->exists()) {
                                $fail('Книги з ідентифікатором ' . $bookId . ' не існує.');
                            }
                        }
                    }
                }],
        ];
    }
}
