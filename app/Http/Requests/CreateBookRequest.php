<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           "title"=> "required|string|min:7",
            "isbn"=> ["required",'string', "max:20",
            Rule::unique('books','isbn')->ignore($this->route('book'),'id')],
            "description"=> "nullable|string",
            "published_at"=> "required|date",
            "total_copies"=> "nullable|integer|max:200",
            "cover_image"=> "required|string",
            "price"=> "required|numeric",
            "author_id"=> "required|exists:authors,id",
            "genra"=> "required|string"
        ];
    }
}
