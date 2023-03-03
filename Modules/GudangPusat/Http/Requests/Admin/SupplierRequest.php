<?php

namespace Modules\GudangPusat\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'PUT') {
            $nama = 'required|unique:supplier,nama,' . $this->get('id');
        } else {
            $nama = 'required|unique:supplier,nama';
        }

        return [
            'nama' => $nama,
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
