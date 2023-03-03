<?php

namespace Modules\GudangPusat\Http\Controllers;

use App\Http\Controllers\Controller;

class GudangPusatController extends Controller
{
    protected $data = [];
    protected $perPage = 10;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = '';
    }
}
