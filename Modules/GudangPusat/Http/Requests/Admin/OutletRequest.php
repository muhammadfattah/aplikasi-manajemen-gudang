<?php

namespace Modules\GudangPusat\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OutletRequest extends FormRequest
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
            $nama          = 'required|unique:outlet,nama,' . $id;
            $id_supervisor = 'required|unique:outlet,id_supervisor,' . $id;
        } else {
            $nama          = 'required|unique:outlet,nama';
            $id_supervisor = 'required|unique:outlet,id_supervisor';
        }
        $lokasi    = 'required';
        $id_cabang = 'required';

        return [
            'nama'          => $nama,
            'lokasi'        => $lokasi,
            'id_supervisor' => $id_supervisor,
            'id_cabang'     => $id_cabang,
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
