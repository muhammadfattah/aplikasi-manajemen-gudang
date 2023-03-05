<?php

namespace Modules\Outlet\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id_barang       = 'required';
        $jumlah = 'required|integer';

        return [
            'id_barang' => $id_barang,
            'jumlah'    => $jumlah,
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
