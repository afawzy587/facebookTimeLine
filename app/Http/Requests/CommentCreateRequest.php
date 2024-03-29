<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationResponseHandler;
use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{

    // use FailedValidationResponseHandler;
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
            'post_id'   => ['required','integer','exists:posts,id'],
            'comment'   => ['required','string', 'min:3','max:250'],
        ];
    }
}
