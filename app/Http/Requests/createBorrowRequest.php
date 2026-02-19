<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createBorrowRequest extends FormRequest
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
            "book_id"=>"required|integer",
        'member_id'=>"required|integer",
        'borrowed_date'=>"required|date",
        'due_date'=> "required|date",
        'returned_date'=>"required|date",
        'status'=> "nullable|string",
        ];
    }
}
