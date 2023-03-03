<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Http\Requests\Admin\CabangRequest;
use Modules\GudangPusat\Repositories\Admin\Interfaces\CabangRepositoryInterface;

class CabangController extends GudangPusatController
{
    // use Authorizable;

    private $cabangRepository;

    public function __construct(CabangRepositoryInterface $cabangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'cabang';

        $this->cabangRepository = $cabangRepository;

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

        $this->data['cabangs'] = $this->cabangRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('gudangpusat::admin.cabang.index', $this->data);
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
        $this->data['cabangs'] = $this->cabangRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.cabang.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['listManajerCabang'] = $this->cabangRepository->getListManajerCabang();
        $this->data['listAdminCabang'] = $this->cabangRepository->getListAdminCabang();
        return view('gudangpusat::admin.cabang.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CabangRequest $request)
    {
        $params = $request->validated();

        if ($this->cabangRepository->create($params)) {
            return redirect('admin/gudang-pusat/cabang')
                ->with('success', __('gudangpusat::cabang.success_create_message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cabang = $this->cabangRepository->findById($id);

        $this->data['cabang'] = $cabang;
        $this->data['listManajerCabang'] = $this->cabangRepository->getListManajerCabang();
        $this->data['listAdminCabang'] = $this->cabangRepository->getListAdminCabang();
        return view('gudangpusat::admin.cabang.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CabangRequest $request, $id)
    {
        $cabang = $this->cabangRepository->findById($id);
        $params = $request->validated();

        if ($this->cabangRepository->update($cabang, $params)) {
            return redirect('admin/gudang-pusat/cabang')
                ->with('success', __('gudangpusat::cabang.success_update_message'));
        }

        return redirect('admin/gudang-pusat/cabang/' . $id . '/edit')
            ->with('error', __('gudangpusat::cabang.fail_update_message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $permanentDelete = (bool)$request->get('_permanent_delete');

        if ($this->cabangRepository->delete($id, $permanentDelete)) {
            if ($permanentDelete) {
                return redirect('admin/gudang-pusat/cabang/trashed')->with('success', __('gudangpusat::cabang.success_delete_message'));
            }

            return redirect('admin/gudang-pusat/cabang')->with('success', __('gudangpusat::cabang.success_delete_message'));
        }

        return redirect('admin/gudang-pusat/cabang')->with('error', __('gudangpusat::cabang.fail_delete_message'));
    }

    public function restore($id)
    {
        if ($this->cabangRepository->restore($id)) {
            return redirect('admin/gudang-pusat/cabang')->with('success', __('gudangpusat::cabang.success_restore_message'));
        }

        return redirect('admin/gudang-pusat/cabang/trashed')->with('error', __('gudangpusat::cabang.fail_restore_message'));
    }
}
