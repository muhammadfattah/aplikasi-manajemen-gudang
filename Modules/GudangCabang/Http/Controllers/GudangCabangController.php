<?php

namespace Modules\GudangCabang\Http\Controllers;

use App\Http\Controllers\Controller;

class GudangCabangController extends Controller
{
    protected $data = [];
    protected $perPage = 10;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = '';
    }
}
