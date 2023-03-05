<?php

namespace Modules\GudangPusat\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'PUT') {
            $nama = 'required|unique:barang,nama,' . $this->get('id');
        } else {
            $nama = 'required|unique:barang,nama';
        }

        return [
            'nama'        => $nama,
            'id_kategori' => 'required',
            'harga'       => 'required|integer'
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
