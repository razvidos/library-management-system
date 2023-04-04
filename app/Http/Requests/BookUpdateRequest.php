<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // todo: realize Vue Authorization
        return Gate::allows('update-book');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'ISBN' => 'required|string|max:20',
            'publish_date' => 'required|date',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
        ];
    }
}
