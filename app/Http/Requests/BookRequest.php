<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Author;

class BookRequest extends FormRequest
{
    use JsonErrorResponseTrait;

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
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'author_ids' => ['required',
                'array',
                function ($attribute, $value, $fail) {
                    if (isset($value) && is_array($value)) {
                        foreach ($value as $authorId) {
                            if (!Author::where('id', $authorId)->exists()) {
                                $fail('Автор з ідентифікатором ' . $authorId . ' не існує.');
                            }
                        }
                    }
                }],
            'published_at' => 'required|date',
        ];
    }
}
