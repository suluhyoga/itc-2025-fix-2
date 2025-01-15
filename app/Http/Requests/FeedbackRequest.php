<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|string|max:258',
                'pesan' => 'required|string|max:258'
            ];
        } else {
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|string|max:258',
                'pesan' => 'required|string|max:258'
            ];
        }
    }

    public function message()
    {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'Name wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'pesan.required' => 'Pesan wajib diisi!'
            ];
        } else {

            return [
                'name.required' => 'Name wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'pesan.required' => 'Pesan wajib diisi!'
            ];
        }
    }
}
