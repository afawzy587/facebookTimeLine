<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationResponseHandler;
use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{

    use FailedValidationResponseHandler;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'  => ['required','string', 'min:3','max:250'],
            'body'   => ['required','string', 'min:3','max:1000'],
            'image'  => ['nullable','file', 'image','mimes:png,jpg', 'max:25600'] 
        ];
    }
}
