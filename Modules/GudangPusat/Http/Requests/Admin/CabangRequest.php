<?php

namespace Modules\GudangPusat\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CabangRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->get('id');

        if ($this->method() == 'PUT') {
            $nama       = 'required|unique:cabang,nama,' . $id;
            $id_manajer = 'required|unique:cabang,id_manajer,' . $id;
            $id_admin   = 'required|unique:cabang,id_admin,' . $id;
        } else {
            $nama       = 'required|unique:cabang,nama';
            $id_manajer = 'required|unique:cabang,id_manajer';
            $id_admin   = 'required|unique:cabang,id_admin';
        }
        $lokasi = 'required';

        return [
            'nama'       => $nama,
            'lokasi'     => $lokasi,
            'id_manajer' => $id_manajer,
            'id_admin'   => $id_admin,
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
