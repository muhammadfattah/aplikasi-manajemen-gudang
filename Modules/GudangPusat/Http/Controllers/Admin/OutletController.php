<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Http\Requests\Admin\OutletRequest;
use Modules\GudangPusat\Repositories\Admin\Interfaces\OutletRepositoryInterface;

class OutletController extends GudangPusatController
{
    // use Authorizable;

    private $outletRepository;

    public function __construct(OutletRepositoryInterface $outletRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'outlet';

        $this->outletRepository = $outletRepository;

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

        $this->data['outlets'] = $this->outletRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('gudangpusat::admin.outlet.index', $this->data);
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
        $this->data['outlets'] = $this->outletRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.outlet.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['listSupervisorOutlet'] = $this->outletRepository->getListSupervisorOutlet();
        $this->data['listCabang']           = $this->outletRepository->getListCabang();
        return view('gudangpusat::admin.outlet.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(OutletRequest $request)
    {
        $params = $request->validated();

        if ($this->outletRepository->create($params)) {
            return redirect('admin/gudang-pusat/outlet')
                ->with('success', __('gudangpusat::outlet.success_create_message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $outlet = $this->outletRepository->findById($id);

        $this->data['outlet']               = $outlet;
        $this->data['listSupervisorOutlet'] = $this->outletRepository->getListSupervisorOutlet();
        $this->data['listCabang']           = $this->outletRepository->getListCabang();
        return view('gudangpusat::admin.outlet.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(OutletRequest $request, $id)
    {
        $outlet = $this->outletRepository->findById($id);
        $params = $request->validated();

        if ($this->outletRepository->update($outlet, $params)) {
            return redirect('admin/gudang-pusat/outlet')
                ->with('success', __('gudangpusat::outlet.success_update_message'));
        }

        return redirect('admin/gudang-pusat/outlet/' . $id . '/edit')
            ->with('error', __('gudangpusat::outlet.fail_update_message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $permanentDelete = (bool)$request->get('_permanent_delete');

        if ($this->outletRepository->delete($id, $permanentDelete)) {
            if ($permanentDelete) {
                return redirect('admin/gudang-pusat/outlet/trashed')->with('success', __('gudangpusat::outlet.success_delete_message'));
            }

            return redirect('admin/gudang-pusat/outlet')->with('success', __('gudangpusat::outlet.success_delete_message'));
        }

        return redirect('admin/gudang-pusat/outlet')->with('error', __('gudangpusat::outlet.fail_delete_message'));
    }

    public function restore($id)
    {
        if ($this->outletRepository->restore($id)) {
            return redirect('admin/gudang-pusat/outlet')->with('success', __('gudangpusat::outlet.success_restore_message'));
        }

        return redirect('admin/gudang-pusat/outlet/trashed')->with('error', __('gudangpusat::outlet.fail_restore_message'));
    }
}
