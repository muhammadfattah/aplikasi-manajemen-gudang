<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangPusat\Entities\Barang;
use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Http\Requests\Admin\BarangRequest;
use Modules\GudangPusat\Http\Requests\Admin\StokBarangRequest;
use Modules\GudangPusat\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;

class StokBarangController extends GudangPusatController
{
    // use Authorizable;

    private $stokbarangRepository;

    public function __construct(StokBarangRepositoryInterface $stokbarangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'stok barang';

        $this->stokbarangRepository = $stokbarangRepository;

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

        $this->data['stokbarangs'] = $this->stokbarangRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('gudangpusat::admin.stokbarang.index', $this->data);
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
        $this->data['stokbarangs'] = $this->stokbarangRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.stokbarang.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['listKategori'] = $this->stokbarangRepository->getListKategori();
        return view('gudangpusat::admin.barang.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BarangRequest $request)
    {
        $params = $request->validated();

        if ($this->stokbarangRepository->create($params)) {
            return redirect('admin/gudang-pusat/stok-barang')
                ->with('success', __('gudangpusat::stokbarang.success_create_message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $stokbarang = $this->stokbarangRepository->findById($id);
        $this->data['listKategori'] = $this->stokbarangRepository->getListKategori();
        $this->data['stokbarang'] = $stokbarang;

        return view('gudangpusat::admin.barang.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BarangRequest $request, $id)
    {
        $barang = $this->stokbarangRepository->findById($id);
        $params = $request->validated();

        if ($this->stokbarangRepository->update($barang, $params)) {
            return redirect('admin/gudang-pusat/stok-barang')
                ->with('success', __('gudangpusat::stokbarang.success_update_message'));
        }

        return redirect('admin/gudang-pusat/stok-barang/' . $id . '/edit')
            ->with('error', __('gudangpusat::stokbarang.fail_update_message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $permanentDelete = (bool)$request->get('_permanent_delete');

        if ($this->stokbarangRepository->delete($id, $permanentDelete)) {
            if ($permanentDelete) {
                return redirect('admin/gudang-pusat/stok-barang/trashed')->with('success', __('gudangpusat::stokbarang.success_delete_message'));
            }

            return redirect('admin/gudang-pusat/stok-barang')->with('success', __('gudangpusat::stokbarang.success_delete_message'));
        }

        return redirect('admin/gudang-pusat/stok-barang')->with('error', __('gudangpusat::stokbarang.fail_delete_message'));
    }

    public function restore($id)
    {
        if ($this->stokbarangRepository->restore($id)) {
            return redirect('admin/gudang-pusat/stok-barang')->with('success', __('gudangpusat::stokbarang.success_restore_message'));
        }

        return redirect('admin/gudang-pusat/stok-barang/trashed')->with('error', __('gudangpusat::stokbarang.fail_restore_message'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function tambah_stok($id)
    {
        $stokbarang = $this->stokbarangRepository->findById($id);
        $this->data['listSupplier'] = $this->stokbarangRepository->getListSupplier();
        $this->data['stokbarang'] = $stokbarang;
        return view('gudangpusat::admin.stokbarang.form', $this->data);
    }

    public function update_stok(StokBarangRequest $request, $id)
    {
        $stokBarang = $this->stokbarangRepository->findStokBarangById($id);
        $params = $request->validated();

        if ($this->stokbarangRepository->updateStok($stokBarang, $params)) {
            return redirect('admin/gudang-pusat/stok-barang')
                ->with('success', __('gudangpusat::stokbarang.success_update_message'));
        }

        return redirect('admin/gudang-pusat/stok-barang/' . $id . '/edit')
            ->with('error', __('gudangpusat::stokbarang.fail_update_message'));
    }
}
