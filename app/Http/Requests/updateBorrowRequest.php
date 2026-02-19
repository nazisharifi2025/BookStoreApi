<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateBorrowRequest extends FormRequest
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
               "book_id"=>"nullable|integer",
        'member_id'=>"nullable|integer",
        'borrowed_date'=>"nullable|date",
        'due_date'=> "nullable|date",
        'returned_date'=>"nullable|date",
        'status'=> "nullable|string",
        ];
    }
}
