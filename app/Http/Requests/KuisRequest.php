<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KuisRequest extends FormRequest
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
                'judul' => 'required|string|max:258',
                'kategori' => 'required|string|max:258',
                'pertanyaan' => 'required|string|max:258'
            ];
        } else {
            return [
                'judul' => 'required|string|max:258',
                'kategori' => 'required|string|max:258',
                'pertanyaan' => 'required|string|max:258'
            ];
        }
    }

    public function message()
    {
        if (request()->isMethod('post')) {
            return [
                'judul.required' => 'Judul wajib diisi!',
                'kategori.required' => 'Kategori wajib diisi!',
                'pertanyaan.required' => 'Pertanyaan wajib diisi!'
            ];
        } else {

            return [
                'judul.required' => 'Judul wajib diisi!',
                'kategori.required' => 'Kategori wajib diisi!',
                'pertanyaan.required' => 'Pertanyaan wajib diisi!'
            ];
        }
    }
}
