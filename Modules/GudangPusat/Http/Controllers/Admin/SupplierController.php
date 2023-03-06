<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Http\Requests\Admin\SupplierRequest;
use Modules\GudangPusat\Repositories\Admin\Interfaces\SupplierRepositoryInterface;

class SupplierController extends GudangPusatController
{
    // use Authorizable;

    private $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'supplier';

        $this->supplierRepository = $supplierRepository;

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

        $this->data['suppliers'] = $this->supplierRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('gudangpusat::admin.supplier.index', $this->data);
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
        $this->data['suppliers'] = $this->supplierRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.supplier.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gudangpusat::admin.supplier.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SupplierRequest $request)
    {
        $params = $request->validated();

        if ($this->supplierRepository->create($params)) {
            return redirect('admin/gudang-pusat/supplier')
                ->with('success', __('gudangpusat::supplier.success_create_message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $supplier = $this->supplierRepository->findById($id);

        $this->data['supplier'] = $supplier;

        return view('gudangpusat::admin.supplier.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SupplierRequest $request, $id)
    {
        $supplier = $this->supplierRepository->findById($id);
        $params = $request->validated();

        if ($this->supplierRepository->update($supplier, $params)) {
            return redirect('admin/gudang-pusat/supplier')
                ->with('success', __('gudangpusat::supplier.success_update_message'));
        }

        return redirect('admin/gudang-pusat/supplier/' . $id . '/edit')
            ->with('error', __('gudangpusat::supplier.fail_update_message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $permanentDelete = (bool)$request->get('_permanent_delete');

        if ($this->supplierRepository->delete($id, $permanentDelete)) {
            if ($permanentDelete) {
                return redirect('admin/gudang-pusat/supplier/trashed')->with('success', __('gudangpusat::supplier.success_delete_message'));
            }

            return redirect('admin/gudang-pusat/supplier')->with('success', __('gudangpusat::supplier.success_delete_message'));
        }

        return redirect('admin/gudang-pusat/supplier')->with('error', __('gudangpusat::supplier.fail_delete_message'));
    }

    public function restore($id)
    {
        if ($this->supplierRepository->restore($id)) {
            return redirect('admin/gudang-pusat/supplier')->with('success', __('gudangpusat::supplier.success_restore_message'));
        }

        return redirect('admin/gudang-pusat/supplier/trashed')->with('error', __('gudangpusat::supplier.fail_restore_message'));
    }
}
