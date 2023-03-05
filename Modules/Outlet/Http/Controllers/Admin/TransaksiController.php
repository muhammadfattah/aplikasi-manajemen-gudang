<?php

namespace Modules\Outlet\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\Outlet\Http\Controllers\OutletController;
use Modules\Outlet\Http\Requests\Admin\TransaksiRequest;
use Modules\Outlet\Repositories\Admin\Interfaces\TransaksiRepositoryInterface;

class TransaksiController extends OutletController
{
    // use Authorizable;

    private $transaksiRepository;

    public function __construct(TransaksiRepositoryInterface $transaksiRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'transaksi';

        $this->transaksiRepository = $transaksiRepository;

        $this->data['viewTrash'] = false;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $options = [
            'per_page' => $this->perPage,
            'order' => [
                'created_at' => 'desc',
            ],
            'filter' => $params,
        ];

        $this->data['transaksis'] = $this->transaksiRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('outlet::admin.transaksi.index', $this->data);
    }

    public function trashed(Request $request)
    {
        $params = $request->all();

        $options = [
            'per_page' => $this->perPage,
            'order' => [
                'created_at' => 'desc',
            ],
            'filter' => $params,
        ];

        $this->data['viewTrash'] = true;
        $this->data['transaksis'] = $this->transaksiRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('outlet::admin.transaksi.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['listBarang'] = $this->transaksiRepository->getListBarang();
        return view('outlet::admin.transaksi.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TransaksiRequest $request)
    {
        $params = $request->validated();

        if ($this->transaksiRepository->create($params)) {
            return redirect('admin/outlet/transaksi')
                ->with('success', __('outlet::transaksi.success_create_message'));
        }
    }
}
