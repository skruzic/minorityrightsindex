<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
            'text' => 'required',
            'type' => 'required',
        ];
    }
}
