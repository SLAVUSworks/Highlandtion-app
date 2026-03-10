<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JuknisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_event' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string'],
        ];

        if ($this->isMethod('POST')) {
            $rules['file_pdf'] = ['required', 'file', 'mimes:pdf', 'max:10240'];
        } else {
            $rules['file_pdf'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nama_event.required' => 'Nama event wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'file_pdf.required'   => 'File PDF wajib diunggah.',
            'file_pdf.mimes'      => 'File harus berformat PDF.',
            'file_pdf.max'        => 'Ukuran file maksimal 10MB.',
        ];
    }
}
