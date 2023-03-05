<?php

namespace Modules\Outlet\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OutletController extends Controller
{
    protected $data = [];
    protected $perPage = 10;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = '';
    }
}
