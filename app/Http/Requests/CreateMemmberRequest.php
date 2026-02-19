<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemmberRequest extends FormRequest
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
             'name'=> "required|string|min:6",
            'email'=>"required|string",
            'address'=>"required|string",
            'membership_date'=> "nullable|date",
            'whatsApp_number'=>"nullable|string|max:10",
            'status'=> "nullable|string",
        ];
    }
}
